<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    // Muestra el formulario para crear o editar una especialidad
    public function index(Request $req)
    {
        if ($req->id) {
            $especialidad = Especialidad::find($req->id);
            if (!$especialidad) {
                return redirect()->route('especialidades')->with('error', 'Especialidad no encontrada.');
            }
        } else {
            $especialidad = new Especialidad();
        }
        return view('especialidad', compact('especialidad'));
    }

    // Muestra la lista de especialidades
    public function list()
    {
        $especialidades = Especialidad::all();
        return view('especialidades', compact('especialidades'));
    }

    // Obtiene una especialidad por ID para la API
    public function getAPI(Request $req)
    {
        $especialidad = Especialidad::find($req->id);
        if ($especialidad) {
            return response()->json($especialidad);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Especialidad no encontrada.'], 404);
        }
    }

    // Obtiene todas las especialidades para la API
    public function listAPI()
    {
        $especialidades = Especialidad::all();
        return response()->json($especialidades);
    }

    // Guarda una especialidad (creación o actualización)
    public function save(Request $req)
    {
        $validated = $req->validate([
            'nombre' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:255'],
        ], [
            'nombre.regex' => 'El nombre de la especialidad solo puede contener letras y espacios.',
        ]);
    
        // Verifica si la especialidad ya existe excluyendo la que se está editando
        $exists = Especialidad::where('nombre', $req->nombre)
                    ->where('id', '!=', $req->id) // Excluye la especialidad actual en caso de actualización
                    ->exists();
    
        if ($exists) {
            return redirect()->back()->with('error', 'La especialidad ya existe.');
        }
    
        if ($req->id != 0) {
            $especialidad = Especialidad::find($req->id);
            if (!$especialidad) {
                return redirect()->route('especialidades')->with('error', 'Especialidad no encontrada.');
            }
            $message = 'Especialidad actualizada exitosamente.';
        } else {
            $especialidad = new Especialidad();
            $message = 'Especialidad creada exitosamente.';
        }
    
        $especialidad->nombre = $req->nombre;
        $especialidad->save();
    
        return redirect()->route('especialidades')->with('success', $message);
    }
    
    

    // Guarda una especialidad para la API
    public function saveAPI(Request $req)
    {
        $validated = $req->validate([
            'nombre' => 'required|string|max:255',
        ]);

        if ($req->id != 0) {
            $especialidad = Especialidad::find($req->id);
            if (!$especialidad) {
                return response()->json(['status' => 'error', 'message' => 'Especialidad no encontrada.'], 404);
            }
        } else {
            $especialidad = new Especialidad();
        }

        $especialidad->nombre = $req->nombre;
        $especialidad->save();

        return response()->json(['status' => 'success'], 200);
    }

    // Elimina una especialidad
    public function delete(Request $req)
    {
        $especialidad = Especialidad::find($req->id);

        if ($especialidad) {
            $especialidad->delete();
            return redirect()->route('especialidades')->with('success', 'Especialidad eliminada exitosamente.');
        } else {
            return redirect()->route('especialidades')->with('error', 'Especialidad no encontrada.');
        }
    }

    // Elimina una especialidad para la API
    public function deleteAPI(Request $req)
    {
        $especialidad = Especialidad::find($req->id);

        if ($especialidad) {
            $especialidad->delete();
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Especialidad no encontrada.'], 404);
        }
    }
}
