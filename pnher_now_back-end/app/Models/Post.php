<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','user_id','publish'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function baggage(){
        return $this->HasMany(Baggage::class);
    }
    
    public static function store($request, $id = null) {
        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user()->id,
            'publish'=>$request->publish,
        ];
        $post = self::updateOrCreate(['id' => $id], $data);
        
        return $post;
    }
}
