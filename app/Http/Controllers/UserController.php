<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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
                "message" => "Unauthorized",
                "error" => $e
            ]);

        }
    }
}
