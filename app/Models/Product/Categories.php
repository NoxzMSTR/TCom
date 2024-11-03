<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Each category may have one parent
    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent');
    }

    // Each category may have multiple children
    public function children()
    {
        return $this->hasMany(static::class, 'parent');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
