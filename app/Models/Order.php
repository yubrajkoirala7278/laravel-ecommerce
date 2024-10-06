<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country_name',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'sub_total',
        'shipping_charge',
        'total_charge',
        'coupon_discount',
        'status',
        'payment_status'
    ];
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
    
}
