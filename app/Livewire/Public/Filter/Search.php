<?php
namespace App\Livewire\Public\Filter;

use App\Models\Product\Products;
use App\Models\Product\ProductTags;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Search extends Component
{
    public $placement;

    public $tags;

    public $results = [];
    public $search;
    public $selected;
    public $showDropdown;

    public function updatedSelected()
    {
        $this->emitSelf('valueSelected', $this->selected);
    }

    public function updatedSearch()
    {}

    #[On('value-selected')]
    public function valueSelected($name)
    {
        $this->showDropdown = false;

        $this->redirect(route('public.shop', ['search' => $name]));
    }

    public function query()
    {
        $productResults = Products::where('name', 'LIKE', '%' . $this->search . '%')
            ->distinct()
            ->take(8)
            ->pluck('name');

        try {
            $tags = ProductTags::whereRaw("MATCH(tag) AGAINST(?)", [$this->search])->orWhere('tag', 'LIKE', '%' . $this->search . '%')
                ->distinct()
                ->take(8)
                ->pluck('tag');
        } catch (\Throwable $th) {
            $tags = ProductTags::where('tag', 'LIKE', '%' . $this->search . '%')
                ->distinct()
                ->pluck('tag');
        }

        $results = $productResults->merge($tags)->unique();

        return $results;
    }

    public function updated($property)
    {
        if ($property == 'search') {
            if (strlen($this->search) < 2) {
                $this->results      = collect();
                $this->showDropdown = false;
                return;
            }

            if ($this->query()) {
                $this->results = $this->query();
            } else {
                $this->results = collect();
            }

            $this->selected     = '';
            $this->showDropdown = true;
        }

        // if ($property ==  'search') {
        //     if (empty($this->search)) {
        //         $this->search = null;
        //         $this->tags = null;
        //     } else {
        //         try {
        //             $tags = ProductTags::whereRaw("MATCH(tag) AGAINST(?)", [$this->search])->orWhere('tag', 'LIKE', '%' . $this->search . '%')
        //                 ->distinct()
        //                 ->pluck('tag');
        //         } catch (\Throwable $th) {
        //             $tags = ProductTags::where('tag', 'LIKE', '%' . $this->search . '%')
        //                 ->distinct()
        //                 ->pluck('tag');
        //         }

        //         $this->tags = $tags;
        //     }
        // }
    }

    #[Computed]
    public function searchData()
    {
        $searchData = [];
        if (! empty($this->tags)) {
            foreach ($this->tags as $key => $value) {
                $searchData[] = $value;
            }
        }
        return $searchData;
    }

    public function render()
    {
        return view('livewire.public.filter.search');
    }
}