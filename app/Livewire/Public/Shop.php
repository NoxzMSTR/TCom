<?php
namespace App\Livewire\Public;

use App\Models\Brands;
use App\Models\Product\Products;
use App\Models\Product\ProductVariations;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $title = 'Shop';

    public $breadCrumb = 'Home.Shop';

    public $totalPages = 20;

    public $filter = [];

    public function setFilter($reset = false, $hasSearch = null, $hasCategory = null)
    {
        $products = Products::with(['assets', 'variations', 'categories', 'feedback'])->where('status', 1);

        if ($hasCategory) {
            request()->merge(['category' => $hasCategory]);
        }

        if ($hasSearch) {
            request()->merge(['search' => $hasSearch]);
        }

        if (request('category')) {
            $products = $products->whereHas('categories', function ($query) {
                $query->where('name', 'LIKE', '%' . request('category') . '%');
            });
        }
        if (request('search')) {

            $products = $products->where(function ($query) {
                $query->whereHas('tags', function ($query) {
                    $query->where('tag', 'LIKE', '%' . request('search') . '%');
                })->orWhere('name', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (isset($this->filter['brand'])) {
            $brandIDS = [];
            foreach ($this->filter['brand'] as $id => $value) {
                if ($value) {
                    $brandIDS[] = $id;
                }
            }
            if (count($brandIDS)) {
                $products = $products->whereIn('hasBrand', $brandIDS);
            }
        }

        if (isset($this->filter['variation'])) {
            $varisations = [];
            foreach ($this->filter['variation'] as $type => $typeData) {
                foreach ($typeData as $variation => $value) {
                    if ($value) {
                        $varisations[] = $variation;
                    }
                }
            }
            if (count($varisations)) {
                $products = $products->whereHas('variations', function ($query) use ($varisations) {
                    $query->whereIn('data', $varisations);
                });
            }
        }

        if (isset($this->filter['price'])) {
            $min = isset($this->filter['price']['min']) ? $this->filter['price']['min'] : 0;
            $max = isset($this->filter['price']['max']) ? $this->filter['price']['max'] : 0;

            if (is_numeric($min) && $min) {
                $products = $products->where('amount', '>=', $min);
            }

            if (is_numeric($max) && $max) {
                $products = $products->where('amount', '<=', $max);
            }
        }

        if (isset($this->filter['sort'])) {
            $sortType = (int) $this->filter['sort'];
            if ($sortType == 4) {
                $products = $products->orderBy('amount', 'ASC');
            }
            if ($sortType == 5) {
                $products = $products->orderBy('amount', 'DESC');
            }
            if ($sortType == 1) {
                $products = $products->whereHas('feedback');
            }
            if ($sortType == 3) {
                $products = $products->orderBy('created_at', 'DESC');
            }
        }

        if (isset($this->filter['totalPages'])) {
            $this->totalPages = $this->filter['totalPages'];
        }

        if ($reset) {
            $this->resetPage('shop-page');
        }

        return $products;
    }

    public function render()
    {
        if ($this->totalPages == 0) {
            $products = $this->setFilter()->get();
        } else {
            $products = $this->setFilter()
                ->paginate($this->totalPages, pageName: 'shop-page');
        }

        $brands = Brands::withCount('products')->get();

        $variations = ProductVariations::select('type', 'data', DB::raw('COUNT(products.id) as products_count'))
            ->join('products', 'product_variations.productID', '=', 'products.id') // Adjust the relationship column names
            ->groupBy(['data', 'type'])                                            // Group by the 'name' column of ProductVariations
            ->get();

        return view('livewire.public.shop', ['products' => $products, 'brands' => $brands, 'variations' => $variations])->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}