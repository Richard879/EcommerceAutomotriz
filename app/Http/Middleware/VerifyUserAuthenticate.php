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
<<<<<<< HEAD
            /*app('db')->table('sessions')
                    ->where('user_id', Auth::user()->id)
                    ->delete();*/
=======
            // app('db')->table('sessions')
            //         ->where('user_id', Auth::user()->id)
            //         ->delete();
>>>>>>> 7809a66b415a60d378a054c45cea1ce0d9cb077b

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
