<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product', 'price', 'qty'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function order()
    {
    	return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function getTotalPriceAttribute()
    {
    	return $this->price * $this->qty;
    }
}
