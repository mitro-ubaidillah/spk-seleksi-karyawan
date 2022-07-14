<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Halaman Login";
        return view('auth.login', compact('title'));
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
