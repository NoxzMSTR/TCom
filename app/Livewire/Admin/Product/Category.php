<?php
namespace App\Livewire\Admin\Product;

use App\Models\Product\Categories;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Category extends Component
{
    use WithFileUploads;

    public $title = 'Categories';

    public $breadCrumb = 'Home.Product.Categories';

    #[Validate('required|min:3', message: 'Please provide a category name')]
    public $name = '';
    public $description = '';
    public $tags = '';

    public $thumbnail = '';
    public $showThumbnail = '';
    public $parent = 0;
    public $category;
    public $featured = 0;

    public function mount()
    {}

    #[Computed]
    public function categories()
    {
        $categories = [];
        $category   = Categories::with(['descendants'])->get()->toArray();
        foreach ($category as $key => $cat) {
            $categories[$key]['id']    = $cat['id'];
            $categories[$key]['name']  = $cat['name'];
            $categories[$key]['level'] = 1;
            if (isset($cat['descendants'])) {
                $categories[$key]['child'] = $this->buildCatTree($cat['descendants'], 2);
            }
        }

        return $categories;
    }

    public function buildCatTree($subCats, $level)
    {
        $categories = [];

        foreach ($subCats as $cat) {
            $menuItem = [
                'id'    => $cat['id'],
                'name'  => $cat['name'],
                'level' => $level,
            ];

            // Check if it has children and call the function recursively
            if (! empty($cat['descendants'])) {
                $menuItem['child'] = $this->buildCatTree($cat['descendants'], $level + 1);
            }

            $categories[] = $menuItem;
        }

        return $categories;
    }

    #[On('edit-category')]
    public function beforeEditCategory($id)
    {
        $this->category = Categories::find($id);

        if ($this->category) {
            $this->name          = $this->category->name;
            $this->description   = $this->category->description;
            $this->tags          = $this->category->metaTags;
            $this->showThumbnail = $this->category->thumbnail;
            $this->parent        = $this->category->parent;
            $this->featured      = $this->category->isFeatured;
        }

        $this->dispatch('set-field', parent: $this->parent);
        $this->dispatch('hide-loader');
    }

    public function updateCategory()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $data = [];
        if ($this->category) {

            if ($this->thumbnail) {
                $this->validate(['thumbnail' => 'image|max:1024'], ['thumbnail' => 'Please add a category thumbnail']);
                $file = $this->thumbnail;

                $name = $file->getClientOriginalName();

                $path = $file->storeAs('categories', $name, ['disk' => 'public']);
            }

            if (isset($path) && ! empty($path)) {
                $data += ['thumbnail' => asset($path)];
            }

            $data += [
                'name'        => $this->name,
                'description' => ! empty($this->description) ? $this->description : '',
                'metaTags'    => ! empty($this->tags) ? $this->tags : json_encode([]),
                'parent'      => $this->parent,
                'isFeatured'  => $this->featured,
            ];

            $this->category->update($data);
        }
        $this->showThumbnail = '';
        $this->category      = null;

        $this->dispatch('cat-notification', type: 'success', title: 'Category Updated Successfully', message: 'The category has been successfully updated. 🎉');

        $this->clear();
    }

    public function saveCategory()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        if ($this->thumbnail) {
            $this->validate(['thumbnail' => 'image|max:1024'], ['thumbnail' => 'Please add a category thumbnail']);
            $file = $this->thumbnail;

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('categories', $name, ['disk' => 'public']);
        }

        Categories::create([
            'name'        => $this->name,
            'description' => ! empty($this->description) ? $this->description : '',
            'metaTags'    => ! empty($this->tags) ? $this->tags : json_encode([]),
            'thumbnail'   => isset($path) && ! empty($path) ? asset($path) : '',
            'parent'      => $this->parent,
            'isFeatured'  => $this->featured,
        ]);

        $this->clear();

        $this->dispatch('cat-notification', type: 'success', title: 'Category Saved Successfully', message: 'The category has been successfully saved. 🎉');
    }

    public function updated($property)
    {
        if ($property == 'thumbnail') {
            $this->dispatch('hide-loader');
        }
    }

    public function clear()
    {
        $this->name        = null;
        $this->description = '';
        $this->tags        = null;
        $this->thumbnail   = '';
        $this->parent      = 0;
        $this->featured    = 0;
        $this->dispatch('on-clear');
        $this->dispatch('refreshDatatable');
    }

    public function deleteThumb()
    {
        if ($this->category) {
            $data = [
                'thumbnail' => null,
            ];
            $this->category->update($data);
        }
        $this->showThumbnail = false;
        $this->dispatch('on-clear');
        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.admin.product.category')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
