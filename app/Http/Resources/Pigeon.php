<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pigeon extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'speed' => $this->speed,
            'range' => $this->range,
            'cost' => $this->cost,
            'downtime' => $this->downtime,
            'status' => $this->status,
        ];
    }
}
