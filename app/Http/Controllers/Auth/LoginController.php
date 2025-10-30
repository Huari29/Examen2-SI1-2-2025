<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('livewire.auth.login'); // tu vista de login
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = Usuario::where('correo', $request->email)->first();

        if ($user && Hash::check($request->password, $user->contrasenia)) {
            Auth::login($user, $request->filled('remember'));

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
