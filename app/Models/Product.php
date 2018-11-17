<?php

namespace App\Models;
use App\Scopes\ProductStatusScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'price', 'details', 'brand_id', 'category_id', 'status'];

    public function reviews()
    {
    	return $this->hasMany('App\Models\Review', 'product_id');
    }

    public function stocks()
    {
    	return $this->hasMany('App\Models\Stock', 'product_id');
    }

    public function items()
    {
    	return $this->hasMany('App\Models\OrderItem', 'product_id');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function getOrederedAttribute()
    {
    	return $this->items->sum('qty');
    }

    public function getInStockAttribute()
    {
    	return $this->stocks->sum('count');
    }

    public function getStockAttribute()
    {
    	return $this->in_stock - $this->ordered;
    }

    public function getApiUrlAttribute()
    {
    	return route('api.products.show', $this->id);
    }

    public function getApiReviewsUrlAttribute()
    {
        return route('api.reviews.index', $this->slug);
    }

    public function getApiMakeReviewsUrlAttribute()
    {
        return route('api.reviews.store', $this->slug);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ProductStatusScope);
    }

}
