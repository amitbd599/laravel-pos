<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageViewController extends Controller
{
    
    public function LoginPage(){
        return view('pages.auth.login-page');
    }
    public function RegistrationPage(){
        return view('pages.auth.registration-page');
    }
}
