<?php
namespace App\Livewire\Admin\Vendor;

use App\Exports\Vendor\ProductExport;
use App\Models\Vendors;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VendorDatatable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Vendors::query(); // Select some things
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('id', 'desc');

        $this->setConfigurableAreas([
            'toolbar-right-end' => [
                'livewire.admin.vendor.vendor-el',
                [
                    'type' => 'add',
                ],
            ],
        ]);
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

    public array $bulkActions = [
        'exportSelected' => 'Export Products',
    ];

    public function exportSelected()
    {
        $ids = $this->getSelected();

        return (new ProductExport($ids))->download('exported-products.xlsx');
    }

    public $title = 'Vendor List';

    public $breadCrumb = 'Home.Vendor.List';

    public function view()
    {
        return view('livewire.admin.vendor.vendor-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }

    public function add()
    {
        $this->dispatch('update-vendor', id: 0);
    }
}