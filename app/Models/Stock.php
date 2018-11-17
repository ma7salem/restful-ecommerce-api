<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'count'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
