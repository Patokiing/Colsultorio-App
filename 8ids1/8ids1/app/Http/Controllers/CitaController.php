<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consultorio;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Paciente;


class CitaController extends Controller
{
    public function index()
    {
        try {
            $citas = Cita::with('especialidad')->get();
            return view('citas', compact('citas'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar la lista de citas: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al mostrar la lista de citas.');
        }
    }

    public function V_autorizar(Request $req, $id)
    {
        try {
            $cita = Cita::with('especialidad')->findOrFail($id);
            $doctores = Doctor::all();
            $consultorios = Consultorio::all();
            return view('autorizacion', compact('cita', 'doctores', 'consultorios'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de autorización: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al mostrar el formulario de autorización.');
        }
    }

    public function list()
    {
        try {
            $citas = Cita::all();
            return view('citas', compact('citas'));
        } catch (\Exception $e) {
            Log::error('Error al listar citas: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al listar citas.');
        }
    }

    public function listAPI(Request $request)
    {
        try {
            // Obtener el usuario autenticado
            $user = auth()->user();
    
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }
    
            // Obtener el paciente relacionado con el usuario
            $paciente = Paciente::where('idusr', $user->id)->first();
    
            if (!$paciente) {
                return response()->json(['error' => 'Paciente no encontrado'], 404);
            }
    
            // Obtener solo las citas del paciente autenticado
            $citas = Cita::where('id_paciente', $paciente->id)
                ->with('especialidad')
                ->get();
    
            return response()->json($citas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al listar citas.'], 500);
        }
    }
    
    public function autorizado(Request $req, $id)
    {
        try {
            $cita = new Cita();
            $cita->fech = Cita::findOrFail($id)->fech;
            $cita->id_espe = $req->id_especialidad;
            $cita->id_doc = $req->id_doc;
            $cita->estado = 'Autorizada';
            $cita->save();

            $citaOriginal = Cita::findOrFail($id);
            $citaOriginal->delete();

            Log::info('Cita autorizada y eliminada:', [
                'Cita ID' => $id,
                'Especialidad ID' => $req->id_especialidad,
                'Doctor ID' => $req->id_doc
            ]);

            return redirect()->route('citas')->with('success', 'Cita autorizada y eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al autorizar la cita: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al autorizar la cita.');
        }
    }

    public function saveAPI(Request $req)
    {
        try {
            // Paso 1: Verificar que el usuario esté autenticado
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado.'], 401);
            }
    
            // Paso 2: Verificar que el paciente exista para el usuario autenticado
            $paciente = Paciente::where('idusr', $user->id)->first();
            if (!$paciente) {
                return response()->json(['error' => 'Paciente no encontrado.'], 404);
            }
    
            // Paso 3: Validar que se proporcionen los campos necesarios
            if (!$req->fech || !$req->hora || !$req->id_espe) {
                return response()->json(['error' => 'Faltan campos obligatorios.'], 400);
            }
    
            // Paso 4: Verificar si ya hay 4 citas para esa fecha y especialidad
            $citasDelDia = Cita::where('fech', $req->fech)
                ->where('id_espe', $req->id_espe)
                ->count();
    
            if ($citasDelDia >= 4) {
                return response()->json(['error' => 'No hay más citas disponibles para este día.'], 400);
            }
    
            // Paso 5: Verificar si la hora ya está reservada
            $citaExistente = Cita::where('fech', $req->fech)
                ->where('hora', $req->hora)
                ->where('id_espe', $req->id_espe)
                ->exists();
    
            if ($citaExistente) {
                return response()->json(['error' => 'La hora seleccionada ya está reservada.'], 400);
            }
    
            // Paso 6: Crear la cita
            $cita = new Cita();
            $cita->fech = $req->fech;
            $cita->hora = $req->hora;
            $cita->id_espe = $req->id_espe;
            $cita->id_paciente = $paciente->id;
            $cita->estado = 'Pendiente'; // Estado por defecto
            $cita->obser = $req->obser ?? null; // Campo opcional
    
            // Guardar la cita
            $cita->save();
    
            // Paso 7: Retornar respuesta exitosa
            return response()->json([
                'message' => 'Cita guardada exitosamente.',
                'cita' => $cita
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error al guardar la cita a través de API: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar cita.'], 500);
        }
    }
    

    public function delete(Request $req)
    {
        try {
            $cita = Cita::find($req->id);
            if ($cita) {
                $cita->delete();

                Log::info('Cita eliminada:', [
                    'Cita ID' => $req->id
                ]);

                return redirect()->route('citas')->with('success', 'Cita eliminada correctamente.');
            } else {
                return redirect()->route('citas')->with('error', 'Cita no encontrada.');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar la cita: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al eliminar la cita.');
        }
    }

    public function deleteAPI(Request $req)
    {
        try {
            $cita = Cita::find($req->id);
            if ($cita) {
                $cita->delete();

                Log::info('Cita eliminada a través de API:', [
                    'Cita ID' => $req->id
                ]);

                return "Ok";
            } else {
                return response()->json(['error' => 'Cita no encontrada.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar la cita a través de API: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar cita.'], 500);
        }
    }

    public function atender($id)
    {
        try {
            $cita = Cita::findOrFail($id);
            return view('atender.cita', compact('cita'));
        } catch (\Exception $e) {
            Log::error('Error al procesar la cita para atención: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al procesar la cita para atención.');
        }
    }

    public function obtenerHorariosDisponibles(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'fech' => 'required|date',
                'id_espe' => 'required|integer|exists:especialidades,id',
            ]);
    
            $fecha = $request->input('fech');
            $idEspe = $request->input('id_espe');
    
            // Horarios disponibles por defecto (cada 2 horas)
            $horariosPorDefecto = ['08:00', '10:00', '12:00', '14:00', '16:00'];
    
            // Obtener las horas ya reservadas para esa fecha y especialidad
            $horasReservadas = Cita::where('fech', $fecha)
                ->where('id_espe', $idEspe)
                ->pluck('hora')
                ->toArray();
    
            // Filtrar las horas disponibles
            $horariosDisponibles = array_diff($horariosPorDefecto, $horasReservadas);
    
            // Limitar a 4 citas por día
            $horariosDisponibles = array_slice($horariosDisponibles, 0, 4);
    
            return response()->json([
                'horarios_disponibles' => array_values($horariosDisponibles),
            ]);
        } catch (\Exception $e) {
            Log::error('Error en obtenerHorariosDisponibles: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error al obtener horarios disponibles.',
                'details' => $e->getMessage(), // Solo en entorno de desarrollo
            ], 500);
        }
    } 
}
