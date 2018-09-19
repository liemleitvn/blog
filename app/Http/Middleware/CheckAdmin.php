<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if (\Auth::guard('admin')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }
            //abort(401);
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
