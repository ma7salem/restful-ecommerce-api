<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Resources\Review\ReviewCollection;

class ReviewController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('store');
	}

    public function index($slug)
    {
    	$product = Product::whereSlug($slug)->firstOrFail();
    	return ReviewCollection::collection($product->reviews)	;
    }

    public function show($slug, Review $review)
    {
    	$product = Product::whereSlug($slug)->firstOrFail();
    	return new ReviewResource($review);
    }

    public function store($slug, ReviewRequest $request)
    {
    	$product = Product::whereSlug($slug)->firstOrFail();
    	$user    = auth()->id();
    	$review  = Review::firstOrCreate(
    		['product_id' => $product->id, 'user_id' => $user],
    	 	['review' => $request->review, 'stars' => $request->stars]);
    	return new ReviewResource($review);
    }

}
