<?php

use App\Http\Controllers\PageViewController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp-code', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);



// Page routes
Route::get('/login', [PageViewController::class, 'LoginPage']);
Route::get('/registration', [PageViewController::class, 'RegistrationPage']);
Route::get('/send-otp', [PageViewController::class, 'SendOTPPage']);
Route::get('/verify-otp', [PageViewController::class, 'VerifyOTPPage']);
Route::get('/reset-pass', [PageViewController::class, 'ResetPassPage']);
Route::get('/dashboard', [PageViewController::class, 'DashboardPage']);
