<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea){
        $liker = auth()->user(); #the person who has to be logged in user
        $liker->likes()->attach($idea); #In order to Add manyToMany relationship likes() (use brakets), use attach() method that available in ManyToMany Relationship

        return redirect()->route('dashboard')->with('success', "Liked successfully!");

    }
    public function unlike(Idea $idea){
        $liker = auth()->user(); #the person who has to be logged in user
        $liker->likes()->detach($idea); #

        return redirect()->route('dashboard')->with('success', "Unliked successfully!");

    }
}
