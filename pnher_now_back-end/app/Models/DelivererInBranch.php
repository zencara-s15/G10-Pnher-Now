<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelivererInBranch extends Model
{
    use HasFactory;

    protected $fillable = ['deliverer_id', 'branch_id'];
}
