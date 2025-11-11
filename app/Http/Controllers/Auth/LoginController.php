<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function ShowLogin(){
        return view('Auth/login');
    }


    function StoreLoginForm(Request $request){
         
    }
}
