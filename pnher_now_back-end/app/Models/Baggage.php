<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baggage extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'weight',
        'receiver_phone',
        'sending_address',
        'company',
        'receiving_address',
        'status',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}