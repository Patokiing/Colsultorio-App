<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function googleLogin(Request $request)
    {
        $tokenId = $request->input('tokenId');

        try {
            $googleUser = Socialite::driver('google')->userFromToken($tokenId);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $email = $googleUser->getEmail();
        $name = $googleUser->getName();

        $user = User::where('email', $email)->first();

        if (!$user) {
            // Crea un nuevo usuario
            $user = User::create([
                'email' => $email,
                'name' => $name,
                'password' => Hash::make('password'), // Puedes generar una contraseña aleatoria
                'rol' => 'P', // Asigna el rol 'P' por defecto
            ]);
        }

        // Crea o actualiza el paciente asociado
        Paciente::updateOrCreate(
            ['idusr' => $user->id], // Condición para buscar el paciente
            [
                'nombre' => $name,
                'ApPat' => '',
                'ApMat' => '',
                'tele' => '',
                'idusr' => $user->id,
            ]
        );

        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
