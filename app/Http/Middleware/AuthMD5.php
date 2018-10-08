<?php

namespace App\Http\Middleware;

use Closure;

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

        $headers = apache_request_headers();

        if(!isset($headers['Authorization'])) {
            return response()->json(['error'=>'Token is required']);
        }

        if($headers['Authorization'] !== '73fbb1ad64035c5baa210e63b8166f30') {
            return response()->json(['token invailid'], 401);
        }
        return $next($request);
    }
}
