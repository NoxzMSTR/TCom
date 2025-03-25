<?php
namespace App\Livewire\Admin\Product;

use App\Models\Product\Products;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProductDatatable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Products::query()
            ->with(['categories']); // Select some things
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make('Thumbnail', 'thumbnail')
                ->unclickable()
                ->format(function ($value, $row, $col) {
                    // Use a Blade view for custom actions
                    return view('livewire.admin.product.product-el', ['type' => 'image', 'value' => $value, 'data' => $row]);
                })->collapseOnMobile(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Category", "categories.name")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('Actions', 'id')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->format(function ($value, $row, $col) {
                    // Use a Blade view for custom actions
                    return view('livewire.admin.product.product-el', ['type' => 'product_action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }

    public $title = 'Product List';

    public $breadCrumb = 'Home.Product.List';

    public function view()
    {
        return view('livewire.admin.product.product-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }
}
