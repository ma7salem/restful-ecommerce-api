<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'address', 'phone', 'status'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function items()
    {
    	return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function getTotalPriceAttribute()
    {
    	$total = 0;
    	foreach ($this->items as $key => $item) {
    		$total += $item->total_price;
    	}
    	return $total;
    }

    public function getUserNameAttribute()
    {
        return isset($this->user->name) ? $this->user->name : 'Unknown';
    }

    public function getTimeAttribute()
    {
        return isset($this->created_at) ? $this->created_at->diffForHumans() : 'Unknown';
    }

    public function getApiUrlAttribute()
    {
        return route('api.order.show', $this->id);
    }
}
