<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Resources\Brand\BrandCollection;

class BrandController extends Controller
{
    private $_paginator = 15;

    public function index()
    { 
    	return BrandCollection::collection(Brand::paginate($this->_paginator));
    }
}
