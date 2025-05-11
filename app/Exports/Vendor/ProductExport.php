<?php
namespace App\Exports\Vendor;

use App\Exports\Vendor\Sheets\ProductSheet;
use App\Models\Vendors;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductExport implements WithMultipleSheets
{
    use Exportable;

    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->ids as $key => $value) {
            $vendor = Vendors::find($value);
            if ($vendor) {
                $sheets[] = new ProductSheet($vendor->company, $value);
            }

        }

        return $sheets;
    }
}
