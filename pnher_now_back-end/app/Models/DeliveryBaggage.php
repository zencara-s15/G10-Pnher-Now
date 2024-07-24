<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DeliveryBaggage extends Model
{
    use HasFactory;
    protected $fillable = [ 'deliverer_id', 'baggage_id'];
    public function baggage()
    {
        return $this->belongsTo(Baggage::class, 'baggage_id');
    }

    public function deliverer()
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }
}
