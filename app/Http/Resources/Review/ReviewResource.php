<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'customer'     => $this->user->name,
            'body'         => $this->review,
            'rate'         => $this->stars,
            'product'      => [

                'name'     => $this->product->name,
                'links'    => [
                    'data'  => $this->product->api_url,
                ],
            ],
        ];
    }
}
