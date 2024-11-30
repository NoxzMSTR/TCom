<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brands;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class BrandDatatable extends DataTableComponent
{
    protected $model = Brands::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            ImageColumn::make('Thumbnail', 'thumbnail')
                ->location(
                    fn($row) => $row->thumbnail
                )
                ->attributes(fn($row) => [
                    'class' => 'symbol w-40px',
                    'alt' => $row->name . ' thumbnail',
                ]),
            Column::make("Name", "name")
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
                    return view('livewire.admin.brand.partials.brand-el', ['type' => 'action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }
}
