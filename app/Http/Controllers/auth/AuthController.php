<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los campos ingresados
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Intentar autenticar al usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'usuario no registrado o contraseña incorrecta');
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
