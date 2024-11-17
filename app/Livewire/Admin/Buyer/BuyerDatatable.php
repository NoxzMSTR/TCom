<?php

namespace App\Livewire\Admin\Buyer;

use App\Models\Buyers;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class BuyerDatatable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Buyers::query(); // Select some things
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
            Column::make("Buyer Type", "type")
                ->sortable(),
            Column::make("Name", "firstName")
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
                    return view('livewire.admin.buyer.buyer-el', ['type' => 'action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }

    public $title = 'Buyer List';

    public $breadCrumb = 'Home.Buyer.List';

    public function view()
    {
        return view('livewire.admin.buyer.buyer-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }
}
