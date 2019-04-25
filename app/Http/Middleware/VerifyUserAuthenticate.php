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
            // Auth::logout();

            // remueve todas las sesiones realacionas al usuario actual
            // app('db')->table('sessions')
            //         ->where('user_id', Auth::user()->id)
            //         ->delete();

            Auth::logout();
            $request->session()->invalidate();

            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Su acceso esta restringido. '
                ], 401);
            }

            abort(401, 'Su acceso esta restringido.');
        }
        return $next($request);
    }
}
