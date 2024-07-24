<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ideas(){
        return $this->hasMany(Idea::class)->latest(); //->orderBy("created_at", "DESC")
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    //follower_id = our_id
    //user_id = followed users id
    public function followings(){
       return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }
    public function followers(){
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    public function follows(User $user){
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    //Define a management relationship
    public function likes(){
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps(); #Pass the table name - idea_like, withTimestamps() to make sure created and updated that fields are set properly
    }

    //Check if any User likes any specific idea
    public function likesIdea(Idea $idea){
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }

    public function getImageURL(){
        if($this->image){
            return url('storage/', $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$this->name}}";
    }
}
