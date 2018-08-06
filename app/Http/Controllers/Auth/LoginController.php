<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validateLogin($request);        
 
        $user   = $request->usuario;
        $pass   = $request->password;

        $usuario = DB::select('exec usp_User_Validate ?, ?', 
                                                        array($user, $pass));

        $userdata = array(
                        'usuario' => $user,
                        'password' => $pass
                    );

        //echo count($usuario);
        //print_r($usuario);

        /*if (Auth::attempt($userdata)){
            return redirect()->route('main');
        }*/
        if (count($usuario) > 0){
            //Auth::login(1, true);
            //Auth::attempt(['usuario' => $usuario[0]->usuario,'password' => $usuario[0]->password]);
            //Auth::loginUsingId($usuario[0]->id);
            //Session::put('user', 'RICHA');
            //Auth::user()->$usuario[0]->usuario;
            //Session::put('user', $usuario[0]->usuario);
            return redirect()->route('main');
        }
 
       return back()
        ->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));
 
    }
 
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);
    }
 
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
