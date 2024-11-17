<?php

namespace App\Livewire\Admin\Vendor;

use App\Models\User;
use App\Models\Vendors;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class VendorDatatable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Vendors::query(); // Select some things
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Company", "company")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Phone", "phone")
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
                    return view('livewire.admin.vendor.vendor-el', ['type' => 'action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }

    public $title = 'Vendor List';

    public $breadCrumb = 'Home.Vendor.List';

    public function view()
    {
        return view('livewire.admin.vendor.vendor-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }
}
