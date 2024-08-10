<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function subCategory(){
        return $this->hasMany(SubCategory::class);
    }
    protected $fillable = ['name', 'slug', 'status', 'image'];
  
}
