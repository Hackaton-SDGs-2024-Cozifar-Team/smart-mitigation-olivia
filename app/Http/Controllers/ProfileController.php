<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('all.pages.profile.index');
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'no_telp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);
        
        try {
            $user = Auth::user();
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);
            
            return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profile.');
        }
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);
        
        try {
            $user = Auth::user();
            
            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password lama tidak benar.');
            }
            
            // Update password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            
            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah password.');
        }
    }
}
