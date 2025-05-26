<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultoriosController extends Controller
{
    public function index(Request $req){
        if($req->id){
            $consultorio = Consultorio::find($req->id);
        }
        else{
            $consultorio = new Consultorio();
        }
        return view('consultorio',compact('consultorio'));
    }
    public function list(){
        $consultorios = Consultorio::all();
        return view('consultorios',compact('consultorios'));
    }
    public function listAPI(){
        $consultorios = Consultorio::all();
        return $consultorios;
    }
    public function save(Request $req){
        if($req->id !=0){
            $consultorio = Consultorio::find($req->id);
        }
        else{
            $consultorio = new Consultorio();
        }
        
        $consultorio -> numero = $req->nombre;
        $consultorio->save();  
        return redirect()-> route('consultorios');

    }
    public function saveAPI(Request $req){
        if($req->id !=0){
            $consultorio = Consultorio::find($req->id);
        }
        else{
            $consultorio = new Consultorio();
        }
    
        $consultorio -> numero = $req->nombre;
        $consultorio->save();  
        return "ok";
    }
    public function delete(Request $req){
        $consultorio = Consultorio::find($req->id);
        $consultorio->delete();
        return redirect()-> route('consultorios');

    }
    public function deleteAPI(Request $req){
        $consultorio = Consultorio::find($req->id);
        $consultorio->delete();
        return "ok";

    }
}
