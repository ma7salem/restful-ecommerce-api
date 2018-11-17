<?php

namespace App\Models;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'details', 'status'];

    public function products()
    {
    	return $this->hasMany('App\Models\Product', 'category_id');
    }

    public function getApiUrlAttribute()
    {
    	return route('api.products.category', $this->slug);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
