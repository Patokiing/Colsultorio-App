<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medicamento;
use App\Models\AtencionCita;
use Illuminate\Support\Facades\Log;

class AtenderCitaController extends Controller
{
    public function atender($id)
    {
        try {
            $cita = Cita::findOrFail($id);
    
            // Obtener solo los medicamentos de la especialidad de la cita
            $medicamentos = Medicamento::where('especialidad_id', $cita->id_espe)->get();

    
            return view('atender', compact('cita', 'medicamentos'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la página de atención de cita: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al cargar la página de atención de cita.');
        }
    }
    

    public function guardarAtencion(Request $request, $id)
    {
        try {
            $cita = Cita::findOrFail($id);
            $observaciones = $request->input('observaciones_doctor');
    
            // Limpiar medicamentos anteriores
            $cita->medicamentos()->detach();
    
            // Guardar observaciones
            $atencionCita = new AtencionCita();
            $atencionCita->cita_id = $cita->id;
            $atencionCita->observaciones_doctor = $observaciones;
            $atencionCita->save();
    
            // Guardar medicamentos seleccionados
            if ($request->has('medicamentos')) {
                $medicamentos = $request->input('medicamentos');
                foreach ($medicamentos as $medicamentoId => $datos) {
                    // Solo guardar medicamentos con cantidad válida
                    if (isset($datos['cantidad']) && !empty($datos['cantidad'])) {
                        $cantidad = $datos['cantidad'];
                        $frecuencia = isset($datos['frecuencia']) ? $datos['frecuencia'] : null;
    
                        // Agregar medicamento
                        $cita->medicamentos()->attach($medicamentoId, [
                            'cantidad' => $cantidad,
                            'frecuencia' => $frecuencia
                        ]);
                    }
                }
            }
    
            $cita->estado = 'Atendida';
            $cita->save();
    
            Log::info('Cita atendida:', [
                'Cita ID' => $cita->id,
                'Observaciones Doctor' => $observaciones,
                'Medicamentos' => $request->input('medicamentos'),
            ]);
    
            return redirect()->route('citas')->with('success', 'Cita atendida exitosamente.')->with('show_receta', $cita->id);
        } catch (\Exception $e) {
            Log::error('Error al atender la cita: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al atender la cita: ' . $e->getMessage());
        }
    }
    
    public function verReceta($id)
    {
        try {
            $atencionCita = AtencionCita::where('cita_id', $id)->firstOrFail();
            $cita = Cita::with('medicamentos')->findOrFail($id);
            return view('receta', compact('atencionCita', 'cita'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la receta: ' . $e->getMessage());
            return redirect()->route('citas')->with('error', 'Error al cargar la receta.');
        }
    }

    // En AtenderCitaController.php
public function obtenerRecetaAlternativa($id)
{
    try {
        // Obtenemos la cita junto con los medicamentos y las observaciones
        $cita = Cita::with('medicamentos')->findOrFail($id);
        $atencionCita = AtencionCita::where('cita_id', $id)->firstOrFail();

        // Preparar los datos a devolver
        $receta = [
            'cita_id' => $cita->id,
            'observaciones_doctor' => $atencionCita->observaciones_doctor,
            'medicamentos' => $cita->medicamentos,
        ];

        // Devolver la receta en formato JSON
        return response()->json($receta);
    } catch (\Exception $e) {
        Log::error('Error al cargar la receta alternativa: ' . $e->getMessage());
        return response()->json(['error' => 'Error al cargar la receta alternativa.'], 500);
    }
}

   
    
    
    
    
}
