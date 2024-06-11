<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){

        $ideas = Idea::orderBy('created_at', 'DESC');
        //Check if there is search
        //If there is, check the search value with our database
        //Where content like %test% or id = 5
        if(request()->has('search')){
          $ideas = $ideas->where('content','like', '%'. request()->get('search', ''). '%');
        }

        return view('dashboard',[
            'ideas'=> $ideas->paginate(5)
        ]);
    }
}




// $users = [
//     [
//         'name' => 'Alex',
//         'age' => '30',
//     ],
//     [
//         'name' => 'Dan',
//         'age' => '25',
//     ],
//     [
//         'name' => 'John',
//         'age' => '17',
//     ],
// ];
// return view('dashboard',
// [
//     'users' => $users
// ]
// );
