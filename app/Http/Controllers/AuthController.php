<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticated(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
 
         $credentials = $request->only('username', 'password');
         if(Auth::attempt($credentials)){
             $user = Auth::user();
            if($user->level == 'admin'){
                $request->session()->regenerate();
                return redirect()->intended('admin');
            }elseif($user->level == 'pegawai'){
                $request->session()->regenerate();
                return redirect()->intended('pegawai');
            }
            return redirect()->intended('/');
        }
        return redirect('login');
    }
}
