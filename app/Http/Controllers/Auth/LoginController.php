<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Model;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect('/dashboard'); // ubah dari '/' ke '/dashboard'
        }

        return back()->withInput($request->only('phone'))->with('error', 'Nomor telepon atau password salah.');
    }
}