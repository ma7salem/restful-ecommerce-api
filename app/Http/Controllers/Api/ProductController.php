<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
	private $_paginator = 15;

    public function index()
    {
    	return ProductCollection::collection(Product::paginate($this->_paginator));
    }

    public function show(Product $product)
    {
    	return new ProductResource($product);
    }

    public function category($slug)
    {
    	$category = Category::whereSlug($slug)->firstOrFail();
    	return ProductCollection::collection($category->products()->paginate($this->_paginator));
    }

    public function brand($slug)
    {
    	$brand = Brand::whereSlug($slug)->firstOrFail();
    	return ProductCollection::collection($brand->products()->paginate($this->_paginator));
    }
}
