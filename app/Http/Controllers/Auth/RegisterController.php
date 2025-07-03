<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:8,20|numeric|unique:users,phone',
            'password' => 'required|string|min:5|confirmed',
        ], [
            'name.min' => 'Nama minimal 5 karakter.',
            'name.unique' => 'Nama sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.digits_between' => 'Nomor telepon minimal 8 digit.',
            'phone.numeric' => 'Nomor telepon wajib angka.',
            'password.min' => 'Password minimal 5 karakter.',
            'password.confirmed' => 'Konfirmasi password harus sama dengan password.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Registrasi berhasil, silakan login.');
    }
}