<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'like',
    ];

    //Relationship with Comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Define Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
