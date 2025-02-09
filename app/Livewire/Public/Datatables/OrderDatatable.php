<?php

namespace App\Livewire\Public\Datatables;

use App\Models\User;
use App\Models\Order\Orders;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

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
            Column::make("Tracking #", "trackingNo")
                ->sortable(),
            Column::make("Buyer Name", "userFirstName")
                ->sortable(),
            Column::make("Shipping To", "shippingPostalCode")
                ->sortable(),
            Column::make("Billing To", "deliveryPostalCode")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('Status', 'status')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->format(function ($value, $row, $col) {
                    // Use a Blade view for custom actions
                    return view('livewire.public.partials.account.order-el', ['type' => 'order_status', 'data' => $row]);
                })->collapseOnMobile(),
            Column::make('Actions', 'id')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->format(function ($value, $row, $col) {
                    // Use a Blade view for custom actions
                    return view('livewire.public.partials.account.order-el', ['type' => 'order_action', 'data' => $row]);
                })->collapseOnMobile(),
        ];
    }
}
