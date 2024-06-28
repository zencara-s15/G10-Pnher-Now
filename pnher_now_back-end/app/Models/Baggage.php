<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Baggage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'type',
        'weight',
        'receiver_phone',
        'sending_address',
        'receiver_address',
        'post_id',
        'company'
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public static function store($request, $id = null) {
        $data = $request->only(
            'type',
            'weight',
            'receiver_phone',
            'sending_address',
            'receiver_address',
            'post_id',
            'company'
        );
        $baggage = self::updateOrCreate(['id' => $id], $data);
        return $baggage;
    }
}
