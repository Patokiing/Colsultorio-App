<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $material = Material::find($req->id);
        }
        else{
            $material = new Material();
        }
        return view('material',compact('material'));
    }
    public function list(){
        $materiales = Material::all();
        return view('materiales',compact('materiales'));
    }
    public function listAPI(){
        $materiales = Material::all();
        return $materiales;
    }
    public function save(Request $req){
        if($req->id !=0){
            $material = Material::find($req->id);
        }
        else{
            $material = new Material();
        }
        
        $material -> codigo = $req->codigo;
        $material -> descrip = $req->descrip;
        $material -> pres = $req->pres;
        $material -> fec_cad = $req->fec_cad;
        $material -> exis = $req->exis;
        $material->save();  

        return redirect()-> route('materiales');

    }
    public function saveAPI(Request $req){
        if($req->id !=0){
            $material = Material::find($req->id);
        }
        else{
            $material = new Material();
        }

        $material -> codigo = $req->codigo;
        $material -> descrip = $req->descrip;
        $material -> pres = $req->pres;
        $material -> fec_cad = $req->fec_cad;
        $material -> exis = $req->exis;
        $material->save(); 
        return "ok";
    }
    public function delete(Request $req){
        $material = Material::find($req->id);
        $material->delete();
        return redirect()-> route('materiales');

    }
    public function deleteAPI(Request $req){
        $material = Material::find($req->id);
        $material->delete();
        return "ok";

    }
}
