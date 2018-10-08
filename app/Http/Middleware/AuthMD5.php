<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class AuthMD5
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //lay thong tin header request
        $headers = apache_request_headers();

        //Kiem tra co ton tai Authoziration trong header khong (token)
        if(!isset($headers['Authorization'])) {
            return response()->json(['error'=>'Token is required']);
        }

        //Kiem tra token request co trung khop voi token he thong
        //Config::get('authmd5.auth_md5')) lay thong tin token he thong trong file config/authmd5.php
        if($headers['Authorization'] !== Config::get('authmd5.auth_md5')) {
            return response()->json(['token invailid'], 401);
        }
        return $next($request);
    }
}
