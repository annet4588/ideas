<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    //Define relationship on the Model, to define what columns to load- user: id,name(no space)
    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $fillable = [
        'user_id',
        'content',
    ];

    //Relationship with Comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Define Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Define a management relationship, to give us all the users that have liked the post
    public function likes(){
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps(); #Pass the table name - idea_like, withTimestamps() to make sure created and updated that fields are set properly
    }

}
