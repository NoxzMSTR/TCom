<?php

namespace App\Models\Product;

use App\Models\Brands;
use App\Models\Product\Categories;
use App\Models\Vendors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->hasOne(Categories::class, 'id', 'category');
    }

    public function assets()
    {
        return $this->hasMany(ProductAssets::class, 'productID', 'id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariations::class, 'productID', 'id');
    }

    public function vendor()
    {
        return $this->hasOne(Vendors::class, 'id', 'hasVendor');
    }

    public function brand()
    {
        return $this->hasOne(Brands::class, 'id', 'hasBrand');
    }

    public function feedback()
    {
        return $this->hasMany(ProductFeedBack::class, 'productID', 'id');
    }

    public function tags()
    {
        return $this->hasMany(ProductTags::class, 'productID', 'id');
    }

    public function specification()
    {
        return $this->hasMany(ProductSpecification::class, 'productID', 'id');
    }

    function hasFeedBack()
    {
        return $this->feedback()->count();
    }
}
