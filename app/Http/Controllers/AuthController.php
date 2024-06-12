<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function register(){
      return view('auth.register');
    }

     public function store(){
      //validate the users data
      //create a user
      //login the user imidiately (sometimes)
      //redirect them
        $validated = request()->validate(
            [
                'name'=>'required|min:3|max:40',
                'email'=>'required|email|unique:users,email', //Table - users, colomn- email
                'password'=>'required|confirmed|min:8'
            ]
        );

        User::create(
            [
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'password'=> Hash::make($validated['password']),
            ]
        );
        return redirect()->route('dashboard')->with('success', 'Account created Successfully');

    }
}
