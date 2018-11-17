<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Category\CategoryCollection;

class CategoryController extends Controller
{
	private $_paginator = 15;

    public function index()
    {
    	return CategoryCollection::collection(Category::paginate($this->_paginator));
    }


}
