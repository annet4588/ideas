<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $user = User::create(
            [
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'password'=> Hash::make($validated['password']),
            ]
        );

        //Send a welcome email to users
        Mail::to($user->email)
        ->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'Account created Successfully');

    }

    public function login(){
        return view('auth.login');
      }

       public function authenticate(){

        // dd(request()->all());

        //validate the users data
        //redirect them
          $validated = request()->validate(
              [
                  'email'=>'required|email', //Table - users, colomn- email
                  'password'=>'required|min:8'
              ]
          );

          if(auth()->attempt($validated)){
            //Clear the previous session
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in Successfully');
          }

          return redirect()->route('login')->withErrors([
            'email' => "No matching user found with provided email and password"
          ]);
      }

      //Logout function
      public function logout(){
        auth()->logout();
        request()->session()->invalidate(); //to clear all sessions and cookies
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged out Successfully');
      }
}
