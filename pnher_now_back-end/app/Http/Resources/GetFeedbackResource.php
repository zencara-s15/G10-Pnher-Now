<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFeedbackResource extends JsonResource
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
            'user' => [
                'id'=>$this->user->id,
                'first_name'=>$this->user->first_name,
                'last_name'=>$this->user->last_name,
                'profile'=>$this->user->profile],
            'title' => $this->title,
            'comment'=> $this->comment,
            'deliverer' => [
                'first_name' => $this->delivererAndUser->deliverer_id,
                'last_name' => $this->delivererAndUser->deliverer->last_name,
            ],
            'rates'=>$this->rates,
            'create' => $this->created_at->isoFormat('Do-MMM-Y'),
            'update' => $this->updated_at->isoFormat('Do-MMM-Y'),
        ];
    }
}
