<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function showLoginForm(){
        return view ('auth.login');
    }


        //validar la peticion del inicio del usuario
    public function login(Request $request){
        $this->validateLogin($request);
      
    
        //verificando que el usuario y contra sean correctas
        if(Auth::attempt(['usuario' => $request->usuario , 'password' => $request->password ,'condicion' => 1 ])){
            //si exite el usuario
            return redirect()->route('main');
        }
        // si ocurre un error, lo redirecionamos atras
        return back()->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));

    }


    protected function validateLogin(Request $request){
        $this->validate($request, [
            //validando los campos
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
