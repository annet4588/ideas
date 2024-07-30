<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
        //Check if the user is an admin
        // if(!auth()->user()->is_admin){
        //    abort(403); #403 -Forbidden
        // }
        // Log::info('inside admin dashboard controller');
        return view('admin.dashboard'); #admin prefix
    }
}
