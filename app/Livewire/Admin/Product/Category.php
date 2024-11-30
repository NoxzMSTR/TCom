<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\Product\Categories;

class Category extends Component
{
    use WithFileUploads;

    public $title = 'Categories';

    public $breadCrumb = 'Home.Product.Categories';

    #[Validate('required|min:3', message: 'Please provide a category name')]
    public $name = '';
    public $description = '';
    public $tags = '';
    #[Validate('image|max:1024', message: 'Please add a category thumbnail')]
    public $thumbnail = '';
    public $showThumbnail = '';
    public $parent = 0;
    public $category;
    public $featured = 0;

    public function mount() {}

    #[Computed]
    public function categories()
    {
        $categories = [];
        $category = Categories::with(['descendants'])->get();
        foreach ($category as $key => $cat) {
            $categories[$cat->id] = $cat->name;
            if ($cat->descendants->count()) {
                foreach ($cat->descendants as $child) {
                    $categories[$child->id] = $cat->name . '->' . $child->name;
                }
            }
        }

        return $categories;
    }

    #[On('edit-category')]
    public function beforeEditCategory($id)
    {
        $this->category = Categories::find($id);

        if ($this->category) {
            $this->name = $this->category->name;
            $this->description = $this->category->description;
            $this->tags = $this->category->metaTags;
            $this->showThumbnail = $this->category->thumbnail;
            $this->parent = $this->category->parent;
            $this->featured = $this->category->isFeatured;
        }

        $this->dispatch('hide-loader');
    }

    public function updateCategory()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $data = [];
        if ($this->category) {

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
                'metaTags' => !empty($this->tags) ? $this->tags : json_encode([]),
                'parent' => $this->parent,
                'isFeatured' => $this->featured,
            ];


            $this->category->update($data);
        }
        $this->showThumbnail = '';
        $this->category = null;
        $this->clear();
    }

    public function saveCategory()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        if ($this->thumbnail) {
            $file = $this->thumbnail;

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('categories', $name, ['disk' => 'public']);
        }

        Categories::create([
            'name' => $this->name,
            'description' => !empty($this->description) ? $this->description : '',
            'metaTags' => !empty($this->tags) ? $this->tags : json_encode([]),
            'thumbnail' => isset($path) && !empty($path) ? asset($path) : '',
            'parent' => $this->parent,
            'isFeatured' => $this->featured,
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
        $this->tags = null;
        $this->thumbnail = '';
        $this->parent = 0;
        $this->featured = 0;

        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.admin.product.category')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
