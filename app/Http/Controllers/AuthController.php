<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        // dd($request->all());
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'Administrator Sistem') {
                return redirect('/admin');
            } else if (auth()->user()->role == 'Petugas Pencatatan'){
                return redirect('/petugas');
            } else if (auth()->user()->role == 'Manajemen BUMDes'){
                return redirect('/manajement');
            } else if (auth()->user()->role == 'Supervisor'){
                return redirect('/supervisor');
            }
            return redirect('/login')->with('error', 'Anda tidak memiliki hak akses');
        }
 
        return redirect('/login')->with('error', 'Email atau password salah');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
