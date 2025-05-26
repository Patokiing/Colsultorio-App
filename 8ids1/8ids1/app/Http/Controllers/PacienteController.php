<?php
namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PacienteController extends Controller
{
    public function index(Request $req)
    {
        $citas = Cita::all();
        $usuarios = User::all();

        if ($req->id) {
            $paciente = Paciente::find($req->id);

            if ($paciente) {
                $paciente->tele = Crypt::decryptString($paciente->tele);
            }
        } else {
            $paciente = new Paciente();
        }

        return view('paciente', compact('paciente', 'citas', 'usuarios'));
    }

    public function list()
    {
        $pacientes = Paciente::all();
        return view('pacientes', compact('pacientes'));
    }

    public function listAPI()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    public function saveAPI(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ApPat' => 'required|string|max:255',
            'ApMat' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $request->nombre . ' ' . $request->ApPat . ' ' . $request->ApMat;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->rol = 'P'; // Rol por defecto 'P' para paciente
            $user->save();

            $paciente = new Paciente();
            $paciente->nombre = $request->nombre;
            $paciente->ApPat = $request->ApPat;
            $paciente->ApMat = $request->ApMat;
            $paciente->tele = Crypt::encryptString($request->tele);
            $paciente->idusr = $user->id;
            $paciente->save();

            Log::info('Paciente registrado mediante API', [
                'paciente_id' => $paciente->id,
                'nombre' => $paciente->nombre,
                'ApPat' => $paciente->ApPat,
                'ApMat' => $paciente->ApMat,
                'email' => $user->email,
                'ip' => $request->ip()
            ]);

            DB::commit();
            return response()->json(['message' => 'Paciente registrado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar paciente mediante API', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al registrar paciente'], 500);
        }
    }

    public function save(Request $req)
    {
        DB::beginTransaction();

        try {
            if ($req->id != 0) {
                $paciente = Paciente::find($req->id);
                $message = 'Paciente actualizado correctamente.';
            } else {
                $paciente = new Paciente();
                $message = 'Paciente registrado correctamente.';
            }

            $paciente->nombre = $req->nombre;
            $paciente->ApPat = $req->ApPat;
            $paciente->ApMat = $req->ApMat;
            $paciente->tele = $req->tele ? Crypt::encryptString($req->tele) : null;

            if ($req->idusr) {
                $paciente->idusr = $req->idusr;
            } else {
                $paciente->idusr = $this->createUserAndGetId($req);
            }

            $paciente->save();

            Log::info('Paciente guardado', [
                'paciente_id' => $paciente->id,
                'nombre' => $paciente->nombre,
                'ApPat' => $paciente->ApPat,
                'ApMat' => $paciente->ApMat,
                'email' => User::find($paciente->idusr)->email,
                'ip' => $req->ip()
            ]);

            DB::commit();
            return redirect()->route('pacientes')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar paciente', ['error' => $e->getMessage()]);
            return redirect()->route('pacientes')->with('error', 'Error al guardar paciente.');
        }
    }

    private function createUserAndGetId(Request $req)
    {
        $user = new User();
        $user->name = $req->nombre . ' ' . $req->ApPat . ' ' . $req->ApMat;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->rol = 'P'; // Rol de paciente
        $user->save();

        return $user->id;
    }

    public function delete(Request $req)
    {
        DB::beginTransaction();

        try {
            $paciente = Paciente::find($req->id);

            if ($paciente) {
                $paciente->delete();
                Log::info('Paciente eliminado', [
                    'paciente_id' => $paciente->id,
                    'nombre' => $paciente->nombre,
                    'ApPat' => $paciente->ApPat,
                    'ApMat' => $paciente->ApMat,
                    'email' => User::find($paciente->idusr)->email,
                    'ip' => $req->ip()
                ]);

                DB::commit();
                return redirect()->route('pacientes')->with('success', 'Paciente eliminado correctamente.');
            } else {
                return redirect()->route('pacientes')->with('error', 'Paciente no encontrado.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar paciente', ['error' => $e->getMessage()]);
            return redirect()->route('pacientes')->with('error', 'Error al eliminar paciente.');
        }
    }

    public function deleteAPI(Request $req)
    {
        DB::beginTransaction();

        try {
            $paciente = Paciente::find($req->id);

            if ($paciente) {
                $paciente->delete();
                Log::info('Paciente eliminado mediante API', [
                    'paciente_id' => $paciente->id,
                    'nombre' => $paciente->nombre,
                    'ApPat' => $paciente->ApPat,
                    'ApMat' => $paciente->ApMat,
                    'email' => User::find($paciente->idusr)->email,
                    'ip' => $req->ip()
                ]);

                DB::commit();
                return response()->json(['message' => 'Paciente eliminado correctamente'], 200);
            }

            DB::rollBack();
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar paciente mediante API', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al eliminar paciente'], 500);
        }
    }

    public function showAPI($id)
    {
        $paciente = Paciente::find($id);
    
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
    
        $paciente->tele = Crypt::decryptString($paciente->tele);
    
        // Incluye datos del usuario asociado
        $user = User::find($paciente->idusr);
    
        return response()->json([
            'paciente' => $paciente,
            'user' => $user
        ]);
    }
    
    public function updateAPI(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ApPat' => 'required|string|max:255',
            'ApMat' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        DB::beginTransaction();

        try {
            $paciente = Paciente::find($id);
            if (!$paciente) {
                return response()->json(['error' => 'Paciente no encontrado'], 404);
            }

            $paciente->nombre = $request->nombre;
            $paciente->ApPat = $request->ApPat;
            $paciente->ApMat = $request->ApMat;
            $paciente->tele = Crypt::encryptString($request->tele);
            $paciente->save();

            $user = User::find($paciente->idusr);
            $user->name = $request->nombre . ' ' . $request->ApPat . ' ' . $request->ApMat;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Paciente actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar paciente'], 500);
        }
    }


    //Obtener solos los datos
    public function getPacienteData()
    {
        // Obtén el usuario logueado
        $user = Auth::user(); // Devuelve el usuario autenticado
    
        // Verifica que el usuario exista
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
    
        // Obtener los datos del paciente relacionado con este usuario
        $paciente = $user->paciente;  // Asume que el usuario tiene una relación con el modelo Paciente
    
        if ($paciente) {
            // Desencriptar el teléfono
            $telefonoDesencriptado = Crypt::decryptString($paciente->tele);
    
            // Incluir la contraseña sin encriptar (esto es solo para fines de prueba, no en producción)
            $passwordDesencriptado = $user->password;
    
            return response()->json([
                'paciente' => [
                    'nombre' => $paciente->nombre,
                    'ap_paterno' => $paciente->ApPat,
                    'ap_materno' => $paciente->ApMat,
                    'telefono' => $telefonoDesencriptado, // Enviar el teléfono desencriptado
                    'email' => $paciente->usuario->email,  // El correo del usuario relacionado
                    'password' => $passwordDesencriptado,  // Contraseña sin encriptar (NO recomendado en producción)
                ]
            ]);
        } else {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
    }

////Editar datos sin la contraseña :)
public function updatePaciente(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Usuario no autenticado'], 401);
    }

    $paciente = $user->paciente;

    if (!$paciente) {
        return response()->json(['message' => 'Paciente no encontrado'], 404);
    }

    // Validar datos
    $request->validate([
        'nombre' => 'string|max:255',
        'ap_paterno' => 'string|max:255',
        'ap_materno' => 'string|max:255',
        'telefono' => 'string|max:20',
    ]);

    // Actualizar datos en la tabla pacientes
    $paciente->update([
        'nombre' => $request->nombre ?? $paciente->nombre,
        'ApPat' => $request->ap_paterno ?? $paciente->ApPat,
        'ApMat' => $request->ap_materno ?? $paciente->ApMat,
        'tele' => Crypt::encryptString($request->telefono ?? Crypt::decryptString($paciente->tele)),
    ]);

    // Actualizar también la tabla users
    $user->update([
        'name' => trim(($request->nombre ?? $paciente->nombre) . ' ' . 
                       ($request->ap_paterno ?? $paciente->ApPat) . ' ' . 
                       ($request->ap_materno ?? $paciente->ApMat)),
    ]);

    return response()->json(['message' => 'Datos actualizados correctamente']);
}


    
    
}
