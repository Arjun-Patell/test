<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'sku',
        'detail',
        'image',
        'categorys'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }
    public function categoriesComma()
    {
        return $this->categories()->pluck('cat_name')->implode(',');

    }
}
