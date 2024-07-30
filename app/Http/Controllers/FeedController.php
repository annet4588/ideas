<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //Get the user that's going to log in
        $user = auth()->user();

        $followingIDs = $user->followings()->pluck('user_id');
        // dd($followingIDs);

        //Copied from the Dashboard Controller for now -  $ideas = Idea::orderBy('created_at', 'DESC');
        //Changed - where the user_id is from the $followingIDs
        $ideas = Idea::whereIn('user_id', $followingIDs)->latest();

        if(request()->has('search')){
          $ideas = $ideas->where('content','like', '%'. request()->get('search', ''). '%');
        }

        return view('dashboard',[
            'ideas'=> $ideas->paginate(5)
        ]);
    }
}
