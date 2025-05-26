<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\LoginController as ControllersLoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MateUsuController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\MediReceController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AtenderCitaController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[ControllersLoginController::class,'login']);

Route::get('pacientes',[PacienteController::class,'listAPI']);
Route::post('paciente',[PacienteController::class,'getAPI']);
Route::post('paciente/guardar',[PacienteController::class,'saveAPI']);
Route::post('paciente/borrar',[PacienteController::class,'deleteAPI']);

Route::get('especialidades',[EspecialidadController::class,'listAPI']);
Route::post('especialidad',[EspecialidadController::class,'getAPI']);
Route::post('especialidad/guardar',[EspecialidadController::class,'saveAPI']);
Route::post('especialidad/borrar',[EspecialidadController::class,'deleteAPI']);

Route::get('doctores',[DoctorController::class,'listAPI']);
Route::get('doctor',[DoctorController::class,'getAPI']);
Route::post('doctor/guardar',[DoctorController::class,'saveAPI']);
Route::post('doctor/borrar',[DoctorController::class,'deleteAPI']);

Route::get('consultorios',[ConsultoriosController::class,'listAPI']);
Route::post('consultorio',[ConsultoriosController::class,'getAPI']);
Route::post('consultorios/guardar',[ConsultoriosController::class,'saveAPI']);
Route::post('consultorio/borrar',[ConsultoriosController::class,'deleteAPI']);

Route::get('citas',[CitaController::class,'listAPI']);
Route::post('cita',[CitaController::class,'getAPI']);
Route::middleware('auth:sanctum')->post('citas/guardar', [CitaController::class, 'saveAPI']);
Route::middleware('auth:sanctum')->get('/citas', [CitaController::class, 'listAPI']);

Route::post('cita/borrar',[CitaController::class,'deleteAPI']);

Route::get('materiales',[MaterialController::class,'listAPI']);
Route::post('material',[MaterialController::class,'getAPI']);
Route::post('material/guardar',[MaterialController::class,'saveAPI']);
Route::post('material/borrar',[MaterialController::class,'deleteAPI']);

Route::get('materiales_usados',[MateUsuController::class,'listAPI']);
Route::post('mateusu',[MateUsuController::class,'getAPI']);
Route::post('mateusu/guardar',[MateUsuController::class,'saveAPI']);
Route::post('mateusu/borrar',[MateUsuController::class,'deleteAPI']);

Route::get('medicamentos',[MedicamentoController::class,'listAPI']);
Route::post('medicamento',[MedicamentoController::class,'getAPI']);
Route::post('medicamento/guardar',[MedicamentoController::class,'saveAPI']);
Route::post('medicamento/borrar',[MedicamentoController::class,'deleteAPI']);

Route::get('materiales_recetado',[MediReceController::class,'listAPI']);
Route::post('medirece',[MediReceController::class,'getAPI']);
Route::post('medirece/guardar',[MediReceController::class,'saveAPI']);
Route::post('medirece/borrar',[MediReceController::class,'deleteAPI']);


Route::post('paciente/guardar', [PacienteController::class, 'saveAPI']);
Route::get('/pacientes/{id}', [PacienteController::class, 'show']);


// Rutas para la API de pacientes
//Route::get('/pacientes', [PacienteController::class, 'listAPI']);
//Route::get('/paciente/{id}', [PacienteController::class, 'showAPI']);
Route::post('/paciente/guardar', [PacienteController::class, 'saveAPI']);
Route::put('/paciente/actualizar/{id}', [PacienteController::class, 'updateAPI']);
Route::delete('/paciente/eliminar/{id}', [PacienteController::class, 'deleteAPI']);



Route::post('/citas', [CitaController::class, 'saveAPI']);
// En api.php
Route::delete('/citas/{id}', [CitasApiController::class, 'destroy']);

Route::post('/api/pacientes', [PacienteController::class, 'store']);
Route::post('/pacientes', [PacienteController::class, 'store']);

Route::delete('/pacientes/{id}', [PacienteController::class, 'deleteAPI']);





Route::post('/auth/google', [AuthController::class, 'googleLogin']);

Route::post('register', [PacienteController::class, 'saveAPI']);


// En routes/web.php o routes/api.php
// routes/api.php
Route::get('receta-alternativa/{id}', [AtenderCitaController::class, 'obtenerRecetaAlternativa']);






// Ruta protegida por el middleware de autenticación
//Route::get('paciente/data/{id}', [PacienteController::class, 'getPacienteData']);

Route::middleware('auth:sanctum')->get('paciente/data', [PacienteController::class, 'getPacienteData']);

///
Route::middleware('auth:sanctum')->put('/paciente/update', [PacienteController::class, 'updatePaciente']);

//
Route::middleware('auth:sanctum')->put('/paciente/update-password', [PacienteController::class, 'updatePassword']);


Route::get('/citas/horarios-disponibles', [CitaController::class, 'obtenerHorariosDisponibles']);


