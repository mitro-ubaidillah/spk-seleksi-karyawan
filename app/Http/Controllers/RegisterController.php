<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request  )
    {
        // dd($request->all());
        $validateData = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|min:5|max:50|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        
        $validateData['password'] = bcrypt($validateData['password']);
        $validateData['remember_token'] = $request->_token;
        // dd($validateData);
        User::create($validateData);

        return redirect()->route('login')->with('success', 'Pengguna Berhasil didaftarkan!');
    }
}
