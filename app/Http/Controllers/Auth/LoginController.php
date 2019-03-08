<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
// use App\Events\LogoutFromEveryWhere;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user   = $request->usuario;
        $pass   = bcrypt($request->password);

        $userdata = Auth::attempt(['usuario' => $request->usuario,'password' => $request->password, 'condicion' => '1']);

        if ($userdata){
            return redirect()->route('main');
        }

        return back()
            ->withErrors(['usuario' => trans('auth.failed')])
            ->withInput(request(['usuario']));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request)
    {
        // remueve todas las sesiones realacionas al usuario actual
        // app('db')->table('sessions')
        //          ->where('user_id', Auth::user()->id)
        //          ->delete();
        // Auth::logout();
        // $request->session()->invalidate();
        // return redirect('/');

        // broadcast(new LogoutFromEveryWhere(Auth::user()));
        // event(new LogoutFromEveryWhere(Auth::user()));

        Auth::logout();
        $request->session()->invalidate();
        // return redirect('/');
    }
}
