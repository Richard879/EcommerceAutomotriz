<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUserAuthenticate
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
        $user = Auth::user();

        if ($user->condicion == 0) {// Si la Condicion del Usuario está inactiva
            Auth::logout();
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Su acceso esta restringido. '
                ], 403);
            }

            abort(403, 'Su acceso esta restringido.');
        }
        return $next($request);
    }
}
