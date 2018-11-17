<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderCollection;

class OrderController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

	public function index()
	{
		$user   = auth()->user();
		$orders = $user->orders()->orderBy('created_at', 'desc')->paginate(12);
		return OrderCollection::collection($orders);
	}

	public function show($id)
	{
		$user   = auth()->id();
		$order  = Order::whereId($id)->whereUserId($user)->firstOrFail();
		return new OrderResource($order);
	}

    public function store(OrderRequest $request)
    {
    	$user    = auth()->id();
    	$details = ['user_id' => $user, 'address' => $request->address, 'phone' => $request->phone];
    	$errors  = [];
    	$order   = Order::create($details);
    	$counter = 0;
    	if($request->orders){
    		foreach ($request->orders as $key => $items) {
    			$add = [];
    			foreach ($items as $k => $item) {

    				// Check if the key in array is valid or not
    				if(! in_array($k, ['id', 'product', 'price', 'qty'])){
    					$errors[] = $k . ' is not valid.';
    					break;
    				}

    				// Check if the id is valid or not and change it to product_id
    				if($k == 'id'){
    					$k = 'product_id';
	    				$product = Product::find($item);
	    				if($product == null){
	    					$errors[] = 'Product with id ' . $item . ' is not valid.';
	    					break;
	    				}else{
	    					if($product->stock == 0){
	    						$errors[] = 'Product with id ' . $item . ' is out of stock.';
	    						continue;
	    					}
	    				}
	    			}

	    			$add[$k] = $item;

    			}
    			// Add New Item in the order
    			if($add){
    				$add['order_id'] = $order->id;
    				OrderItem::create($add);
    				$counter++;
    			}
    			
    		}
    	}else{
    		$errors[] = 'Order Items can\'t be empty.';
    	}
    	return $errors == [] ? $this->responseJsonApi('success', ['your order number is ' . $order->id]) 
    	: ($counter == 0 ? $this->responseJsonApi('fail', ['0 items added'], $errors) 
    		: $this->responseJsonApi('warning', [$counter . ' items added'],$errors)) ;
    }


    private function responseJsonApi($status, $message = [], $errors = [])
    {
    	$array = [];
    	$array['status']  = $status;
    	$array['message'] = $message;
    	$array['errors']  = $errors;
    	return response()->json($array);
    }
}
