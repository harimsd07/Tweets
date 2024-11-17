<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable =[
        'user_id',
        'content',
        'likes',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
