<?php

namespace App\Http\Controllers;


use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    function UserRegistration(Request $request)
    {
        try {
            User::create(
                $request->all()
            );

            return response()->json([
                "status" => "Success",
                "message" => "User registration successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => "Fail",
                "message" => "User registration unsuccessfully",
                "error" => $e
            ]);
        }

    }

    function UserLogin(Request $request)
    {

        try {
            $count = User::where('email', '=', $request->input('email'))
                ->where('password', '=', $request->input('password'))
                ->count();



            if ($count == 1) {
                // User login
                $token = JWTToken::CreateToken($request->input('email'));
                return response()->json([
                    "status" => "Success",
                    "message" => "Authorized",
                    "token" => $token
                ])->cookie('token',$token,time()+60*24*30);

            } else {
                return response()->json([
                    "status" => "Fail",
                    "message" => "Unauthorized",
                ]);
            }

        } catch (Exception $e) {

            return response()->json([
                "status" => "Fail",
                "message" => "Something went wrong",
                "error" => $e
            ]);

        }
    }

    function SendOTPCode(Request $request)
    {
        try {
            $email = $request->input('email');
            $otp = rand(1000, 9999);

            $count = User::where('email', '=', $email)->count();

            if ($count == 1) {
                // Send OTP
                Mail::to($email)->send(new OTPMail($otp));

                //OTP code table update
                User::where('email', '=', $email)->update(['otp' => $otp]);
                return response()->json([
                    "status" => "Success",
                    "message" => "OTP send email successfully",
                ]);

            } else {
                return response()->json([
                    "status" => "Fail",
                    "message" => "Unauthorized",
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                "status" => "Fail",
                "message" => "Something went wrong",
                "error" => $e
            ]);

        }

    }

    function VerifyOTP(Request $request)
    {
        $email = $request->input("email");
        $otp = $request->input("otp");
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->count();

        if ($count == 1) {
            User::where('email', '=', $email)->update(['otp' => '0']);
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                "status" => "Success",
                "message" => "OTP verification successfully",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "status" => "Fail",
                "message" => "Unauthorized",
            ]);
        }
    }

    function ResetPassword(Request $request)
    {
      
        try {
            $email = $request->header('email');
            $password = $request->input("password");
            User::where("email", "=", $email)->update(["password" => $password]);
            return response()->json([
                "status" => "Success",
                "message" => "Password reset successfully",
            
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => "Fail",
                "message" => "Something went wrong",
                "error" => $e
            ]);
        }
    }
}
