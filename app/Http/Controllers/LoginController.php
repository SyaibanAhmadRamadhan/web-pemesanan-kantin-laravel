<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('authentication.login', [
            'title' => 'login'
        ]);
    }

    public function loginProcess(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $credential['username'], 'password' => $credential['password']])) {
            if (Auth()->user()->role == 'pembeli') {
                $request->session()->regenerate();
                return redirect('/')->with(['success' => 'selamat datang']);
            } elseif (Auth()->user()->role == 'penjual') {
                $request->session()->regenerate();
                return redirect()->route('dashboard.view');
            } elseif (Auth()->user()->role == 'kasir') {
                $request->session()->regenerate();
                return redirect()->route('kasir.pesanan.view');
            }
        }
        return redirect()->route('login.view')->withInput($request->all())->with(['errors_login' => 'username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerate();
        return redirect()->intended('');
    }
}
