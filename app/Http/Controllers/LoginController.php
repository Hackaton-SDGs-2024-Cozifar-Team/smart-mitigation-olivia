<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('all.pages.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $cekLogoin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($cekLogoin)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 'bpbd') {
                return redirect()->route('bpbd.dashboard');
            } else if (Auth::user()->role == 'masyarakat') {
                return redirect()->route('landing-page');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password anda salah.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewRegister()
    {
        return view('all.pages.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required',
            'no_hp' => 'required|numeric',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        if ($request->password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Password dan konfirmasi password harus sama.'])->withInput();
        }

        $validatedData['password'] = Hash::make($request->password);
        User::create($validatedData);
        return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat. Silahkan login.');
    }
}
