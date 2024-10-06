<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'description', 'price', 'compare_price',
        'category_id', 'sub_category_id', 'brand_id', 'is_featured', 'track_qty', 'qty', 'status','image','shipping_returns','max_item_add_to_cart'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images(){
        return $this->morphMany(Image::class,'model');
    }
}
