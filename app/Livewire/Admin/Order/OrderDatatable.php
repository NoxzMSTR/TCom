<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order\Orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class OrderDatatable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Orders::query(); // Select some things
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
            Column::make("invoice #", "invoiceNo")
                ->sortable(),
            Column::make("Buyer", "userRole")
                ->sortable(),
            Column::make("Buyer Name", "userFirstName")
                ->sortable(),
            Column::make("Shipping To", "shippingPostalCode")
                ->sortable(),
            Column::make("Billing To", "deliveryPostalCode")
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
                    return view('livewire.admin.order.order-el', ['type' => 'order_action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }

    public $title = 'Order List';

    public $breadCrumb = 'Home.Order.List';

    public function view()
    {
        return view('livewire.admin.order.order-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }
}
