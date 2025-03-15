<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Product\Products;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Settings\System;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

class Customization extends Component
{
    use WithFileUploads;

    public $title = 'Customization';

    public $breadCrumb = 'Home.Settings.Customization';

    public $products;

    public $color = [];

    public $sliders = [['title' => '', 'description' => '', 'image' => '']];

    public function mount()
    {
        $customizations = System::where('type', 'customization')->get();

        foreach ($customizations as $key => $customization) {
            $field = explode('.', $customization->key);
            if ($field[0] == 'color') {
                $this->color[$field[1]] = $customization->value;
            }
            if ($field[0] == 'sliders') {
                $this->sliders[$field[1]] = json_validate($customization->value) ? json_decode($customization->value, true) : [];
            }
        }
    }

    public function addSlider()
    {
        $index = count($this->sliders);
        $this->sliders[$index] = ['title' => '', 'description' => '', 'image' => ''];

        $this->dispatch('hide-loader');
    }

    public function deleteSlider($index)
    {
        if (isset($this->sliders[$index])) {
            if (isset($this->sliders[$index])) {
                System::where('key', 'sliders.' . $index)->where('type', 'customization')->delete();
            }
            unset($this->sliders[$index]);
        }
        $sliders = [];

        foreach ($this->sliders as $key => $value) {
            $sliders[] = $value;
        }

        $this->sliders = $sliders;

        $this->dispatch('hide-loader');
    }

    public function saveColor()
    {
        $this->dispatch('hide-loader');

        $this->validate([
            'color.heading' => ['required'],
            'color.text' => ['required'],
            'color.secondaryText' => ['required'],
            'color.border' => ['required'],
            'color.content' => ['required'],
            'color.card' => ['required'],
            'color.background' => ['required'],
        ], [
            'color.heading.required' => 'Heading Color is required',
            'color.text.required' => 'Primary Text Color is required',
            'color.secondaryText.required' => 'Secondary Text Color is required',
            'color.border.required' => 'Border Color is required',
            'color.content.required' => 'Border Content is required',
            'color.card.required' => 'Border Card is required',
            'color.background.required' => 'Background Color is required',
        ]);

        foreach ($this->color as $key => $value) {
            $system = System::where('key', 'color.' . $key)->where('type', 'customization')->first();

            if ($system) {
                $system->update([
                    'value' => $value
                ]);
            } else {
                System::create([
                    'key' => 'color.' . $key,
                    'value' => $value,
                    'type' => 'customization'
                ]);
            }
        }
        $this->dispatch('cus-notification', type: 'success', title: 'General Settings Saved Successfully', message: 'The general settings has been successfully saved. 🎉');
    }

    public function saveSlider()
    {
        $this->dispatch('hide-loader');

        $this->validate([
            'sliders.*.image' => ['image', 'max:21024'],
            'sliders.*.title' => ['required']
        ], [
            'sliders.*.title.required' => 'Slider title is required',
            'sliders.*.image' => 'Each slider must be an image not exceeding 20 MB',
        ]);


        foreach ($this->sliders as $index => $sliderData) {
            $system = System::where('key', 'sliders.' . $index)->where('type', 'customization')->first();
            $data = $sliderData;

            if (isset($sliderData['image']) && $sliderData['image'] !== null && $sliderData['image'] !== '') {
                $file = $sliderData['image'];

                $name = $file->getClientOriginalName();

                $path = $file->storeAs('customize', $name, ['disk' => 'public']);
            }

            unset($data['image']);
            if (isset($path)) {
                $data['showImage'] =  isset($path) && !empty($path) ? asset($path) : '';
            }

            if ($system) {
                $system->update([
                    'value' => json_encode($data)
                ]);
            } else {
                System::create([
                    'key' => 'sliders.' . $index,
                    'value' => json_encode($data),
                    'type' => 'customization'
                ]);
            }
            if (isset($path)) {
                unset($path);
            }
        }
        $this->dispatch('cus-notification', type: 'success', title: 'Slider Settings Saved Successfully', message: 'The slider settings has been successfully saved. 🎉');
    }

    public function deleteThumb($index)
    {
        $system = System::where('key', $index)->where('type', 'customization')->first();
        if ($system) {
            if (json_validate($system->value)) {
                $data = json_decode($system->value, true);
                $data['showImage'] = null;
                $system->update([
                    'value' => json_encode($data)
                ]);
                $customizations = System::where('type', 'customization')->where('key', 'LIKE', 'sliders.%')->get();

                foreach ($customizations as $key => $customization) {
                    $field = explode('.', $customization->key);

                    if ($field[0] == 'sliders') {
                        $this->sliders[$field[1]] = json_validate($customization->value) ? json_decode($customization->value, true) : [];
                    }
                }
            }
        }
    }


    public function selectProductForSlider($index, $product)
    {
        if (is_array($product)) {
            foreach ($product as $id => $value) {
                $this->sliders[$index]['product'] = $value;
                $this->sliders[$index]['productID'] = $id;
            }
        }

        $this->products[$index] = null;
    }

    public function updated($property)
    {
        $field = explode('.', $property);
        if (isset($field[1]) && isset($field[2]) && $field[2] == 'product') {
            if (empty($this->sliders[$field[1]][$field[2]])) {
                $this->products[$field[1]] = null;
                $this->sliders[$field[1]]['product'] = null;
                $this->sliders[$field[1]]['productID'] = null;
            } else {
                $this->products[$field[1]] = Products::where('name', 'LIKE', '%' . $this->sliders[$field[1]][$field[2]] . '%')->orderBy('id', 'DESC')->limit(6)->get();
            }
        }
    }

    public function searchData($index)
    {
        $searchData[$index] = [];
        if (isset($this->products[$index])) {
            foreach ($this->products[$index] as $key => $value) {
                $searchData[$index][] = $value;
            }
        }
        return $searchData[$index];
    }

    public function render()
    {
        return view('livewire.admin.settings.customization')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
