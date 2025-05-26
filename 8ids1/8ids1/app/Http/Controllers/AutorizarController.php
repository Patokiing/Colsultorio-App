<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consultorio;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AutorizarController extends Controller
{
    // Mostrar formulario de autorización
    public function showForm($id)
    {
        try {
            $cita = Cita::with('especialidad')->findOrFail($id);
            $doctores = Doctor::all();
            $consultorios = Consultorio::all();
            return view('autorizacion', compact('cita', 'doctores', 'consultorios'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de autorización: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al mostrar el formulario de autorización: ' . $e->getMessage());
        }
    }

    // Guardar cita autorizada o denegada
    public function guardarCita(Request $request, $id)
    {
        try {
            $cita = Cita::findOrFail($id);
            
            if ($request->action == 'autorizar') {
                $cita->id_consul = $request->id_consul;
                $cita->id_espe = $request->id_especialidad;
                $cita->id_doc = $request->id_doc;
                $cita->estado = 'Autorizada';
                $cita->obser = $request->observaciones; // Agregar observaciones
                $cita->save();

                Log::info('Cita autorizada:', [
                    'Cita ID' => $cita->id,
                    'Consultorio' => $cita->id_consul,
                    'Especialidad' => $cita->id_espe,
                    'Doctor' => $cita->id_doc,
                    'Observaciones' => $cita->obser,
                ]);

                return redirect()->route('citas')->with('success', 'Cita autorizada exitosamente.');
            } elseif ($request->action == 'denegar') {
                $cita->estado = 'Denegada';
                $cita->obser = $request->observaciones;
                $cita->save();

                Log::info('Cita denegada:', [
                    'Cita ID' => $cita->id,
                    'Observaciones' => $cita->obser,
                ]);

                return redirect()->route('citas')->with('success', 'Cita denegada exitosamente.');
            }
        } catch (\Exception $e) {
            Log::error('Error al procesar la cita: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al procesar la cita: ' . $e->getMessage());
        }
    }

    // Obtener doctores según especialidad
    public function fetchDoctores(Request $request)
    {
        $id_especialidad = $request->id_especialidad;
        $doctores = Doctor::where('id_especialidad', $id_especialidad)->get();
        return response()->json($doctores);
    }

    // Mostrar formulario de denegación
    public function showDenegacionForm($id)
    {
        try {
            $cita = Cita::with('especialidad')->findOrFail($id);
            return view('denegaciones', compact('cita'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el formulario de denegación: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al mostrar el formulario de denegación: ' . $e->getMessage());
        }
    }
}
