<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'company' => $this->company->name,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'profile' => $this->user->profile
            // 'user' =>$this->user_id->first_name,
        ];
    }
}
