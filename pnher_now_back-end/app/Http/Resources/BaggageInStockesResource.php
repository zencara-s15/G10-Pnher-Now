<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaggageInStockesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'weight' => $this->weight,
            'receiver_phone' => $this->receiver_phone,
            'sending_phone' => $this->sending_phone,
            'company' => $this->company,
            'receiving_address' => $this->receiving_address,
            'post_id' => $this->post_id,
            'status' => $this->deliveryStatus->name,
            'created_at' => $this->created_at->isoFormat('D/M/Y') 
            // 'user' =>$this->user_id->first_name,a
        ];
    }
}
