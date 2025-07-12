<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class logincontroller extends Controller
{

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|min:3',
        'password' => 'required|min:3'
    ]);
    // $hashpas=Hash::make($request->password);
    $user = User::where('username', $request->username)
                  ->first();

    if (!$user) {
        return back()->with('error', 'Username atau password salah');
    }
    if(Hash::check($request->password,$user->password))

    session()->put('role', $user->role);

    switch ($user->role) {
        case 'admin': return redirect('/admin');
        case 'guru': return redirect('/guru');
        case 'siswa': return redirect('/siswa');
        default: return redirect('/login')->with('error', 'Role tidak dikenali');
    }
}
}
