<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'publish','longitude', 'latitude'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryBaggages()
    {
        return $this->hasMany(Delivery_Baggage::class);
    }
    public function baggage()
    {
        return $this->hasMany(Baggage::class);
    }
}
