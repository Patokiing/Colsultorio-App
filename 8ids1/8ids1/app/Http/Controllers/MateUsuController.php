<?php

namespace App\Http\Controllers;

use App\Models\MateUsu;
use App\Models\Cita;
use App\Models\Material;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Match_;

class MateUsuController extends Controller
{
    public function index(Request $req){
        $citas = Cita::all();
        $materiales = Material::all();;
        $mateusus = MateUsu::all();
       
        if($req->id){
            $mateusu = MateUsu::find($req->id);
        }
        else{
            $mateusu = new MateUsu();
        }
        return view('mateusu', compact('mateusu','citas','materiales'));

    }
    public function list(){
        $materiales_usados = MateUsu::all();
        return view('materiales_usados',compact('materiales_usados'));
    }
    public function listAPI(){
        $materiales_usados = MateUsu::all();
        return $materiales_usados;
    }
    
    public function save(Request $req){
        if($req->id !=0){
            $mateusu = MateUsu::find($req->id);
        }
        else{
            $mateusu = new MateUsu();
        }
    
        $mateusu->id_cita = $req->id_cita;
        $mateusu->id_mate = $req->id_mate;
        $mateusu->canti = $req->canti;
        $mateusu->unidad = $req->unidad;
        $mateusu->save();  
        return redirect()->route('materiales_usados');
    }

    public function saveAPI(Request $req){
        if($req->id !=0){
            $mateusu = MateUsu::find($req->id);
        }
        else{
            $mateusu = new MateUsu();
        }

        $mateusu->id_cita = $req->id_cita;
        $mateusu->id_mate = $req->id_mate;
        $mateusu->canti = $req->canti;
        $mateusu->unidad = $req->unidad;
        $mateusu->save();  
        return "ok";
    }
    
    
    public function delete(Request $req){
        $mateusu = MateUsu::find($req->id);
        $mateusu->delete();
        return redirect()-> route('materiales_usados');

    }
    public function deleteAPI(Request $req){
        $mateusu = MateUsu::find($req->id);
        $mateusu->delete();
        return "ok";

    }
}
