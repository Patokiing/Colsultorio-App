<?php

namespace App\Http\Controllers;

use App\Models\MediRece;
use App\Models\Cita;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MediReceController extends Controller
{
    public function index(Request $req){
        $citas = Cita::all();
        $medicamentos = Medicamento::all();;
        $medireces = MediRece::all();
       
        if($req->id){
            $medirece = MediRece::find($req->id);
        }
        else{
            $medirece = new MediRece();
        }
        return view('medirece', compact('medirece','citas','medicamentos'));

    }
    public function list(){
        $materiales_recetado = MediRece::all();
        return view('materiales_recetado',compact('materiales_recetado'));
    }
    public function listAPI(){
        $materiales_recetado = MediRece::all();
        return $materiales_recetado;
    }
    
    public function save(Request $req){
        if($req->id !=0){
            $medirece = MediRece::find($req->id);
        }
        else{
            $medirece = new MediRece();
        }
    
        $medirece->id_cit = $req->id_cit;
        $medirece->id_medi = $req->id_medi;
        $medirece->caant = $req->caant;
        $medirece->uni = $req->uni;
        $medirece->cada = $req->cada;
        $medirece->pordias = $req->pordias;
        $medirece->save();  
        return redirect()->route('materiales_recetado');
    }

    public function saveAPI(Request $req){
        if($req->id !=0){
            $medirece = MediRece::find($req->id);
        }
        else{
            $medirece = new MediRece();
        }

        $medirece->id_cit = $req->id_cit;
        $medirece->id_medi = $req->id_medi;
        $medirece->caant = $req->caant;
        $medirece->uni = $req->uni;
        $medirece->cada = $req->cada;
        $medirece->pordias = $req->pordias;
        $medirece->save();  
        return "ok";
    }
    
    
    public function delete(Request $req){
        $medirece = MediRece::find($req->id);
        $medirece->delete();
        return redirect()-> route('materiales_recetado');

    }
    public function deleteAPI(Request $req){
        $medirece = MediRece::find($req->id);
        $medirece->delete();
        return "ok";

    }
}
