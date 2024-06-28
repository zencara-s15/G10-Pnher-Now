<?php

namespace App\Models;

use App\Models\Supervisor\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','user_id','publish','company'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function baggage(){
        return $this->HasMany(Baggage::class);
    }
    
    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public static function store($request, $id = null) {
        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user()->id,
            'publish'=>$request->publish,
            'company'=>$request->company
        ];
        $post = self::updateOrCreate(['id' => $id], $data);
        
        return $post;
    }
}
