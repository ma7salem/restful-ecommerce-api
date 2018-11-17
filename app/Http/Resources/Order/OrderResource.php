<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $items = [];
        if($this->items){
            foreach ($this->items as $key => $item) {
                $items[] = [
                    'product'       => $item->product,
                    'price'         => $item->price,
                    'quantity'      => $item->qty,
                    'total_price'   => $item->total_price,
                ];
            }
        }
        return [
            'order_number' => $this->id,
            'customer'     => $this->user_name,
            'address'      => $this->phone,
            'total_price'  => $this->total_price,
            'time'         => $this->time,
            'items'        => $items,
        ];
    }
}
