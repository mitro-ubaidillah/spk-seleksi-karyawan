<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticathed(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'username'  =>  'required',
            'password'  =>  'required'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->level == 'admin'){
                $request->session()->regenerate();
                return redirect()->intended('admin');
            }elseif($user->level == 'pegawai'){
                $request->session()->regenerate();
                return redirect()->intended('pegawai');
            }
        }
        // return redirect('/login')->with('error', 'Login Error, cek kembali username dan password');

        return redirect()->route('login')->with('errorLogin', 'Login Gagal');

    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
