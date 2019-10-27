<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'user_id' => $this->user_id,
            'pigeon_id' => $this->pigeon_id,
            'distance' => $this->distance,
            'deadline' => $this->deadline,
            'total_price' => $this->total_price,
            'status' => $this->status,
        ];
    }
}
