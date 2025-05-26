<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    // Mostrar formulario de doctor con especialidades
    public function index(Request $req)
    {
        $especialidades = Especialidad::all();
        $doctor = null;
        if ($req->id) {
            $doctor = Doctor::find($req->id);
            if ($doctor) {
                // Descifrar cédula y teléfono
                $doctor->cedula = Crypt::decryptString($doctor->cedula);
                $doctor->telefono = $doctor->telefono ? Crypt::decryptString($doctor->telefono) : null;
            }
        } else {
            $doctor = new Doctor();
        }
        return view('doctor', compact('doctor', 'especialidades'));
    }

    // Listar todos los doctores
    public function list()
    {
        $doctores = Doctor::all();
        return view('doctores', compact('doctores'));
    }

    // Listar todos los doctores para la API
    public function listAPI()
    {
        $doctores = Doctor::all();
        return response()->json($doctores);
    }

    // Guardar o actualizar doctor
    public function save(Request $req)
    {
        // Validaciones del formulario
        $req->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_especialidad' => 'required|integer',
            'cedula' => 'required',
            'telefono' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $req->id,
            'password' => $req->id == 0 ? 'required' : 'nullable',
        ]);

        DB::beginTransaction();
        try {
            if ($req->id != 0) {
                $doctor = Doctor::find($req->id);
                $user = User::find($doctor->idusr);
                $action = 'Actualización'; // Acción de edición
            } else {
                $doctor = new Doctor();
                $user = new User();
                $action = 'Creación'; // Acción de creación
            }

            // Configurar datos del usuario asociado
            $user->name = $req->nombre . ' ' . $req->apellido_paterno . ' ' . $req->apellido_materno;
            $user->email = $req->email;
            if ($req->password) {
                // Hash seguro para la contraseña
                $user->password = Hash::make($req->password);
            }
            $user->rol = 'D'; // Rol de Doctor
            $user->save();

            // Configurar datos del doctor
            $doctor->idusr = $user->id;
            $doctor->nombre = $req->nombre;
            $doctor->apellido_paterno = $req->apellido_paterno;
            $doctor->apellido_materno = $req->apellido_materno;
            $doctor->id_especialidad = (int) $req->id_especialidad;
            // Cifrar cédula y teléfono
            $doctor->cedula = Crypt::encryptString($req->cedula);
            $doctor->telefono = $req->telefono ? Crypt::encryptString($req->telefono) : null;
            $doctor->email = $req->email; // Si deseas almacenar el email también en la tabla de doctores
            $doctor->save();

            // Registrar la acción (creación o actualización) del doctor
            Log::info("Doctor {$action} exitosamente", [
                'doctor_id' => $doctor->id,
                'nombre' => $doctor->nombre,
                'apellido_paterno' => $doctor->apellido_paterno,
                'apellido_materno' => $doctor->apellido_materno,
                'email' => $doctor->email,
                'especialidad' => $doctor->id_especialidad,
                'usuario_id' => $user->id,
                'ip' => $req->ip()
            ]);

            DB::commit();
            return redirect()->route('doctores')->with('success', 'Doctor guardado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('doctores')->with('error', 'Error al guardar el doctor: ' . $e->getMessage());
        }
    }

    // Guardar o actualizar doctor desde la API
    public function saveAPI(Request $req)
    {
        // Validaciones del formulario
        $req->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_especialidad' => 'required|integer',
            'cedula' => 'required',
            'telefono' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        DB::beginTransaction();
        try {
            if ($req->id != 0) {
                $doctor = Doctor::find($req->id);
                $user = User::find($doctor->idusr);
                $action = 'Actualización'; // Acción de edición
            } else {
                $doctor = new Doctor();
                $user = new User();
                $action = 'Creación'; // Acción de creación
            }

            // Configurar datos del usuario asociado
            $user->name = $req->nombre . ' ' . $req->apellido_paterno . ' ' . $req->apellido_materno;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->rol = 'D'; // Rol de Doctor
            $user->save();

            // Configurar datos del doctor
            $doctor->idusr = $user->id;
            $doctor->nombre = $req->nombre;
            $doctor->apellido_paterno = $req->apellido_paterno;
            $doctor->apellido_materno = $req->apellido_materno;
            $doctor->id_especialidad = (int) $req->id_especialidad;
            // Cifrar cédula y teléfono
            $doctor->cedula = Crypt::encryptString($req->cedula);
            $doctor->telefono = $req->telefono ? Crypt::encryptString($req->telefono) : null;
            $doctor->email = $req->email;
            $doctor->save();

            // Registrar la acción (creación o actualización) del doctor
            Log::info("Doctor {$action} desde API exitosamente", [
                'doctor_id' => $doctor->id,
                'nombre' => $doctor->nombre,
                'apellido_paterno' => $doctor->apellido_paterno,
                'apellido_materno' => $doctor->apellido_materno,
                'email' => $doctor->email,
                'especialidad' => $doctor->id_especialidad,
                'usuario_id' => $user->id,
                'ip' => $req->ip()
            ]);

            DB::commit();
            return "Ok";
        } catch (\Exception $e) {
            DB::rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar doctor
    public function delete(Request $req)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::find($req->id);

            if (!$doctor) {
                return redirect()->route('doctores')->with('error', 'Doctor no encontrado.');
            }

            // Eliminar o actualizar las citas asociadas para evitar violaciones de claves foráneas
            Cita::where('id_doc', $doctor->id)->update(['id_doc' => null]);

            $doctor->delete();

            // Registrar la eliminación del doctor
            Log::info('Doctor eliminado', [
                'doctor_id' => $doctor->id,
                'nombre' => $doctor->nombre,
                'apellido_paterno' => $doctor->apellido_paterno,
                'apellido_materno' => $doctor->apellido_materno,
                'email' => $doctor->email,
                'especialidad' => $doctor->id_especialidad,
                'ip' => $req->ip()
            ]);

            DB::commit();
            return redirect()->route('doctores')->with('success', 'Doctor eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('doctores')->with('error', 'Error al eliminar el doctor: ' . $e->getMessage());
        }
    }

    // Eliminar doctor desde la API
    public function deleteAPI(Request $req)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::find($req->id);

            if (!$doctor) {
                return "Error: Doctor no encontrado.";
            }

            // Eliminar o actualizar las citas asociadas para evitar violaciones de claves foráneas
            Cita::where('id_doc', $doctor->id)->update(['id_doc' => null]);

            $doctor->delete();

            // Registrar la eliminación del doctor desde la API
            Log::info('Doctor eliminado desde API', [
                'doctor_id' => $doctor->id,
                'nombre' => $doctor->nombre,
                'apellido_paterno' => $doctor->apellido_paterno,
                'apellido_materno' => $doctor->apellido_materno,
                'email' => $doctor->email,
                'especialidad' => $doctor->id_especialidad,
                'ip' => $req->ip()
            ]);

            DB::commit();
            return "Ok";
        } catch (\Exception $e) {
            DB::rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}
