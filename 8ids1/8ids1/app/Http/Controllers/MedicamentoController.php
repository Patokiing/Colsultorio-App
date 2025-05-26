<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index(Request $req)
    {
        if($req->id){
            $medicamento = Medicamento::find($req->id);
        } else {
            $medicamento = new Medicamento();
        }
    
        // Obtener todas las especialidades
        $especialidades = \App\Models\Especialidad::all();
    
        // Pasar las especialidades a la vista
        return view('medicamento', compact('medicamento', 'especialidades'));
    }
    

    public function list(){
        $medicamentos = Medicamento::all();
        return view('medicamentos', compact('medicamentos'));
    }

    public function listAPI(){
        $medicamentos = Medicamento::all();
        return $medicamentos;
    }
    public function save(Request $req)
    {
        if($req->id != 0){
            // Si el medicamento ya existe, lo encontramos
            $medicamento = Medicamento::find($req->id);
            $message = 'Medicamento actualizado correctamente.';
        }
        else{
            // Si es un nuevo medicamento, creamos uno nuevo
            $medicamento = new Medicamento();
            $message = 'Medicamento registrado correctamente.';
        }
    
        // Asignamos los valores a los campos del medicamento
        $medicamento->descripcion = $req->descripcion;
        $medicamento->precio = $req->precio;
        $medicamento->fecha_caducidad = $req->fecha_caducidad;
        $medicamento->existencia = $req->existencia;
    
        // Asignamos el ID de la especialidad seleccionada
        $medicamento->especialidad_id = $req->especialidad_id;
    
        // Guardamos el medicamento
        $medicamento->save();
    
        // Redirigimos con un mensaje de éxito
        return redirect()->route('medicamentos')->with('success', $message);
    }
    

    public function saveAPI(Request $req){
        if($req->id != 0){
            $medicamento = Medicamento::find($req->id);
        }
        else{
            $medicamento = new Medicamento();
        }

        $medicamento->codigo = $req->codigo;
        $medicamento->descripcion = $req->descripcion;
        $medicamento->precio = $req->precio;
        $medicamento->fecha_caducidad = $req->fecha_caducidad;
        $medicamento->existencia = $req->existencia;
        $medicamento->save();
        return "ok";
    }

    public function delete($id){
        $medicamento = Medicamento::find($id);
        if ($medicamento) {
            $medicamento->delete();
            return redirect()->route('medicamentos')->with('success', 'Medicamento eliminado correctamente.');
        } else {
            return redirect()->route('medicamentos')->with('error', 'Medicamento no encontrado.');
        }
    }

    public function deleteAPI($id){
        $medicamento = Medicamento::find($id);
        if ($medicamento) {
            $medicamento->delete();
            return "ok";
        } else {
            return "Medicamento no encontrado.";
        }
    }
}
