<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ReviewScope;
class Review extends Model
{
    protected $fillable = ['product_id', 'user_id', 'review', 'stars'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public static function boot()
    {
    	parent::boot();

    	static::addGlobalScope(new ReviewScope);
    }
}
