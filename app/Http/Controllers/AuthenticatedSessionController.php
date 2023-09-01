<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Aquí lo verificamos, el segundo parametro es para recordar la seccion

        if (!Auth::attempt($credential, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => ('CREDENCIALES INCORRECTAS')
            ]);
        }

        //en esta parte del codigo, se redicciona a la seccion luego de haber hecho
        //login, o en la parte donde quiso entrar luego de hacer login, 
        //eso hace el metodo intended

        $request->session()->regenerate();

        return redirect()->intended()->with('status' , 'Te has registrado');
    }

    public function destroy(Request $request){
        // Esta línea cierra la sesión del usuario autenticado en la guardia ('guard') llamada 'web'
        //. Por ejemplo, 'web' es la guardia predeterminada que maneja
        // la autenticación de usuarios normales.
        Auth::guard('web')->logout();
        //Esta línea invalida la sesión actual del usuario. Después de la invalidación, 
        //el usuario ya no estará autenticado.
        $request->session()->invalidate();
        //: Esta línea regenera el token de CSRF (Cross-Site Request Forgery) 
        //para mejorar la seguridad de la aplicación.
        $request->session()->regenerateToken();

        return to_route('login')->with('status' , 'You are logged out');
    }
}

