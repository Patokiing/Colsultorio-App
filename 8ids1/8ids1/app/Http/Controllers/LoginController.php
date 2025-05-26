<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('app')->plainTextToken;
            
            // Aquí aseguramos que el 'user' completo sea enviado
            return response()->json([
                'acceso' => "Ok",
                'error' => "",
                'token' => $token,
                'user' => $user // Enviamos todo el objeto de usuario
            ]);
        } else {
            // Log de intento fallido
            Log::warning('Intento fallido de inicio de sesión desde React', ['email' => $request->email, 'ip' => $request->ip()]);
            
            return response()->json([
                'acceso' => "",
                'token' => "",
                'error' => "No existe usuario o contraseña",
                'user' => null // Aseguramos que el 'user' sea null en caso de error
            ]);
        }
    }

    public function logFailedLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'ip' => 'required|ip',
        ]);

        // Log del intento fallido
        Log::warning('Intento fallido de inicio de sesión desde React', $data);

        return response()->json(['message' => 'Log registrado'], 200);
    }
}
