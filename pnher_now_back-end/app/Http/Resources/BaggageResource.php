<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaggageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone_receiver' => $this->receiver_phone,
            'sending_address'=>$this->sending_address,
            'receiving_address'=>$this->receiving_address,
            'type'=>$this->type,
            'weight'=>$this->weight,
            'company'=>$this->company,
            'delivery_status_id'=>$this->delivery_status_id,
            'post_id'=>$this->user  // Assuming `name` is an attribute of `Baggage`
            
        ];
    }
}
