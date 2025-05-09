<?php
namespace App\Exports\Vendor\Sheets;

use App\Models\Product\Products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductSheet implements FromQuery, WithHeadings, WithTitle, ShouldAutoSize
{
    private $vendor;
    private $name;

    public function __construct($name, $vendor)
    {
        $this->vendor = $vendor;
        $this->name   = $name;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Products::query()
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select([
                'products.sku',
                'products.name',
                'categories.name as category',
                'products.amount',
                'products.retailAmount',
                'products.qty',
                'products.wQty',
            ])
            ->where('hasVendor', $this->vendor)
            ->whereIn('status', [1]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->name;
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Name',
            'Category',
            'Amount',
            'Retailer Amount',
            'Quantity',
            'Warehouse Quantity',
        ];
    }
}