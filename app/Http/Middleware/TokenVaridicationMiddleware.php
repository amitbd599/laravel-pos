<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;

class TokenVaridicationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('Token');
       $res = JWTToken::VerifyToken($token);
       if($res == 'Unauthorized'){
        return response()->json([
            "status" => "Fail",
            "message" => "Unauthorized",
        ],401);
       }else{
        $request->headers()->set("email", $res);
        return $next($request);
       }
        
    }
}
