<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\Brands as ModelsBrands;

class Brands extends Component
{
    use WithFileUploads;

    public $title = 'Brands';

    public $breadCrumb = 'Home.Brands';

    #[Validate('required|min:3', message: 'Please provide a brand name')]
    public $name = '';
    public $description = '';
    public $tags = '';
    #[Validate('image|max:1024', message: 'Please add a brand thumbnail')]
    public $thumbnail = '';
    public $showThumbnail = '';
    public $parent = 0;
    public $brand;

    public function mount() {}

    #[Computed]
    public function categories()
    {
        $categories = [];
        $brand = ModelsBrands::get();
        foreach ($brand as $key => $cat) {
            $categories[$cat->id] = $cat->name;
            if ($cat->descendants->count()) {
                foreach ($cat->descendants as $child) {
                    $categories[$child->id] = $cat->name . '->' . $child->name;
                }
            }
        }

        return $categories;
    }

    #[On('edit-brand')]
    public function beforeEditBrand($id)
    {
        $this->brand = ModelsBrands::find($id);

        if ($this->brand) {
            $this->name = $this->brand->name;
            $this->description = $this->brand->description;
            $this->tags = $this->brand->metaTags;
            $this->showThumbnail = $this->brand->thumbnail;
            $this->parent = $this->brand->parent;
        }

        $this->dispatch('hide-loader');
    }

    public function updateBrand()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $data = [];
        if ($this->brand) {

            if ($this->thumbnail) {
                $file = $this->thumbnail;

                $name = $file->getClientOriginalName();

                $path = $file->storeAs('categories', $name, ['disk' => 'public']);
            }

            if (isset($path) && !empty($path)) {
                $data += ['thumbnail' => asset($path)];
            }

            $data += [
                'name' => $this->name,
                'description' => !empty($this->description) ? $this->description : '',
            ];


            $this->brand->update($data);
        }
        $this->showThumbnail = '';
        $this->brand = null;
        $this->clear();
    }

    public function saveBrand()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        if ($this->thumbnail) {
            $file = $this->thumbnail;

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('categories', $name, ['disk' => 'public']);
        }

        ModelsBrands::create([
            'name' => $this->name,
            'description' => !empty($this->description) ? $this->description : '',
            'thumbnail' => isset($path) && !empty($path) ? asset($path) : '',
        ]);

        $this->clear();
    }

    public function updated($property)
    {
        if ($property == 'thumbnail') {
            $this->dispatch('hide-loader');
        }
    }

    public function clear()
    {
        $this->name = null;
        $this->description = '';
        $this->thumbnail = '';

        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.admin.brand.brands')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
