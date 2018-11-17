<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\Resource;

class BrandCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->details,
            'links'       => [
                'data' => $this->api_url,
            ],
        ];
    }
}
