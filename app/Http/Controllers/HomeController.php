<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){
            $user_type=Auth()->user()->user_type;

            if($user_type=='user'){
                return view('dashboard');
            } 
            
            else if($user_type=='admin'){
                return view('admin.admin_home');
            }

            else{
                return redirect()->back();
            }
        }
    }

    public function post(){
        return view("post");
    }
}
