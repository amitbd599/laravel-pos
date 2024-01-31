<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageViewController extends Controller
{

    public function LoginPage()
    {
        return view('pages.auth.login-page');
    }
    public function RegistrationPage()
    {
        return view('pages.auth.registration-page');
    }
    public function SendOTPPage()
    {
        return view('pages.auth.send-otp-page');
    }
    public function VerifyOTPPage()
    {
        return view('pages.auth.verify-otp-page');
    }
    public function ResetPassPage()
    {
        return view('pages.auth.reset-pass-page');
    }
    public function DashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }
}
