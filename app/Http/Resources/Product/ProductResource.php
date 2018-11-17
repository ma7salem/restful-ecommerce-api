<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->details,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'reviews'     => [

                'link'    => $this->api_reviews_url,
                'make'    => $this->api_make_reviews_url
            ],

            'category'    => [
                'id'    => $this->category->id,
                'name'  => $this->category->name,
                'links' => [
                    'data' => $this->category->api_url,
                ],
            ],

            'brand'       => [
                'id'    => $this->brand->id, 
                'name'  => $this->brand->name,
                'links' => [
                    'data' => $this->brand->api_url,
                ],
            ],
        ];
    }
}
