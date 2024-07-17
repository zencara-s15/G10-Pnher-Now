<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'comment' ,'rates' ,'delivererAndUser_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delivererAndUser(){
        return $this->belongsTo(DelivererAndUser::class,'delivererAndUser_id');
    }
}
