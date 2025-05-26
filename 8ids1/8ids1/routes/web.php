<?php

use App\Http\Controllers\AutorizarController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MediReceController;
use App\Http\Controllers\MateUsuController;
use App\Http\Controllers\HelloControler;
use App\Http\Controllers\AtenderCitaController;
use App\Http\Controllers\LogFileController;
use App\Models\Especialidad;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\Material;
use App\Models\Cita;
use App\Models\MediRece;
use App\Models\MateUsu;
use App\Models\AtencionCita;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', [HelloControler::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('especialidad/nueva',[EspecialidadController::class,'index'])->name('nueva.especialidad')->middleware('auth');
Route::get('especialidades',[EspecialidadController::class,'list'])->name('especialidades')->middleware('auth');
Route::post('especialidad/guardar',[EspecialidadController::class,'save'])->name('guardar.especialidad')->middleware('auth');
Route::post('especialidad/borrar',[EspecialidadController::class,'delete'])->name('borrar.especialidad')->middleware('auth');
Route::post('/fetch-doctores', [DoctorController::class, 'fetchDoctores']);

Route::get('doctor/nueva', [DoctorController::class, 'index'])->name('nueva.doctor')->middleware('auth');
Route::get('doctores', [DoctorController::class, 'list'])->name('doctores')->middleware('auth');
Route::post('doctor/guardar', [DoctorController::class, 'save'])->name('guardar.doctor')->middleware('auth');
Route::post('doctor/borrar', [DoctorController::class, 'delete'])->name('borrar.doctor')->middleware('auth');


Route::get('consultorio/nueva',[ConsultoriosController::class,'index'])->name('nueva.consultorio')->middleware('auth');
Route::get('consultorios',[ConsultoriosController::class,'list'])->name('consultorios')->middleware('auth');
Route::post('consultorio/guardar',[ConsultoriosController::class,'save'])->name('guardar.consultorio')->middleware('auth');
Route::post('consultorio/borrar',[ConsultoriosController::class,'delete'])->name('borrar.consultorio')->middleware('auth');

Route::get('paciente/nueva',[PacienteController::class,'index'])->name('nueva.paciente')->middleware('auth');
Route::get('pacientes',[PacienteController::class,'list'])->name('pacientes')->middleware('auth');
Route::post('paciente/guardar',[PacienteController::class,'save'])->name('guardar.paciente')->middleware('auth');
Route::post('paciente/borrar',[PacienteController::class,'delete'])->name('borrar.paciente')->middleware('auth');

Route::get('medicamento/nueva',[MedicamentoController::class,'index'])->name('nueva.medicamento')->middleware('auth');
Route::get('medicamentos',[MedicamentoController::class,'list'])->name('medicamentos')->middleware('auth');
Route::post('medicamento/guardar',[MedicamentoController::class,'save'])->name('guardar.medicamento')->middleware('auth');
Route::post('medicamento/borrar',[MedicamentoController::class,'delete'])->name('borrar.medicamento')->middleware('auth');

Route::get('material/nueva',[MaterialController::class,'index'])->name('nueva.material')->middleware('auth');
Route::get('materiales',[MaterialController::class,'list'])->name('materiales')->middleware('auth');
Route::post('material/guardar',[MaterialController::class,'save'])->name('guardar.material')->middleware('auth');
Route::post('material/borrar',[MaterialController::class,'delete'])->name('borrar.material')->middleware('auth');

Route::get('cita/nueva',[CitaController::class,'index'])->name('nueva.cita')->middleware('auth');
Route::get('citas',[CitaController::class,'list'])->name('citas')->middleware('auth');
Route::post('cita/guardar',[CitaController::class,'save'])->name('guardar.cita')->middleware('auth');
Route::post('cita/borrar',[CitaController::class,'delete'])->name('borrar.cita')->middleware('auth');

Route::get('cita/{id}/autorizacion',[CitaController::class,'V_autorizar'])->name('autorizar.cita')->middleware('auth');

Route::post('/guardar-cita/{id}', [AutorizarController::class, 'autorizado'])->name('guardar.cita');
Route::post('/guardar-cita/{id}', [AutorizarController::class, 'denegado'])->name('guardar.cita');
Route::post('/guardar-cita/{id}', [AutorizarController::class, 'guardarCita'])->name('guardar.cita');


Route::post('/fetch-doctores', [AutorizarController::class, 'fetchDoctores'])->name('fetch.doctores');
Route::post('/fetch-consultorios', [AutorizarController::class, 'fetchConsultorios'])->name('fetch.consultorio');



Route::get('medirece/nueva',[MediReceController::class,'index'])->name('nueva.medirece')->middleware('auth');
Route::get('materiales_recetado',[MediReceController::class,'list'])->name('materiales_recetado')->middleware('auth');
Route::post('medirece/guardar',[MediReceController::class,'save'])->name('guardar.medirece')->middleware('auth');
Route::post('medirece/borrar',[MediReceController::class,'delete'])->name('borrar.medirece')->middleware('auth');

Route::get('mateusu/nueva',[MateUsuController::class,'index'])->name('nueva.mateusu')->middleware('auth');
Route::get('materiales_usados',[MateUsuController::class,'list'])->name('materiales_usados')->middleware('auth');
Route::post('mateusu/guardar',[MateUsuController::class,'save'])->name('guardar.mateusu')->middleware('auth');
Route::post('mateusu/borrar',[MateUsuController::class,'delete'])->name('borrar.mateusu')->middleware('auth');

Route::get('autorizar/{id}', [AutorizarController::class, 'showForm'])->name('autorizar.cita');
Route::post('guardar-cita/{id}', [AutorizarController::class, 'guardarCita'])->name('guardar.cita');
Route::get('denegar/{id}', [AutorizarController::class, 'showDenegacionForm'])->name('denegar.cita');
Route::post('fetch-doctores', [AutorizarController::class, 'fetchDoctores']);

Route::get('/citas/{id}/atender', [CitaController::class, 'atender'])->name('atender.cita');

Route::get('/citas/{id}/atender', [AtenderCitaController::class, 'atender'])->name('atender.cita');
Route::post('/guardar-atencion/{id}', [AtenderCitaController::class, 'guardarAtencion'])->name('guardar.atencion');

Route::get('/{id}/atender', [AtenderCitaController::class, 'atender'])->name('atender.cita');
Route::post('/{id}/guardar-atencion', [AtenderCitaController::class, 'guardarAtencion'])->name('guardar.atencion');

Route::get('paciente/nueva',[PacienteController::class,'index'])->name('nueva.paciente')->middleware('auth');
Route::get('pacientes',[PacienteController::class,'list'])->name('pacientes')->middleware('auth');
Route::post('paciente/guardar',[PacienteController::class,'save'])->name('guardar.paciente')->middleware('auth');
Route::post('paciente/borrar',[PacienteController::class,'delete'])->name('borrar.paciente')->middleware('auth');
Route::get('/api/pacientes', [PacienteController::class, 'listAPI']);
Route::post('/api/pacientes/guardar', [PacienteController::class, 'saveAPI']);
Route::delete('/api/pacientes/{id}/eliminar', [PacienteController::class, 'deleteAPI']);
Route::get('/api/pacientes/fetch', [PacienteController::class, 'fetchPacientes'])->name('fetch.pacientes');

Route::post('/registrar/paciente', 'App\Http\Controllers\PacienteController@registrar');
// routes/api.php

Route::post('/registrar/paciente', [PacienteController::class, 'saveAPI']);



// routes/web.php

Route::get('/receta/{id}', [AtenderCitaController::class, 'verReceta'])->name('ver.receta');


Route::get('/pacientes', [PacienteController::class, 'list'])->name('pacientes');
Route::put('paciente/actualizar/{id}', [PacienteController::class, 'actualizar']);
Route::get('/paciente/{id}', [PacienteController::class, 'getPaciente']);


Route::get('/pacientes', [PacienteController::class, 'list'])->name('pacientes');
Route::get('/paciente/{id?}', [PacienteController::class, 'index'])->name('paciente.index');
Route::post('/paciente/guardar', [PacienteController::class, 'save']);
Route::delete('/paciente/eliminar/{id}', [PacienteController::class, 'delete']);
Route::post('/paciente/guardar', [PacienteController::class, 'save'])->name('guardar.paciente');



// Ruta para listar especialidades
Route::get('/especialidades', [EspecialidadController::class, 'list'])->name('especialidades');

// Ruta para eliminar una especialidad
Route::delete('/especialidad/borrar', [EspecialidadController::class, 'delete'])->name('borrar.especialidad');

// Mostrar lista de doctores
Route::get('/doctores', [DoctorController::class, 'list'])->name('doctores');

// Eliminar doctor
Route::post('/borrar-doctor', [DoctorController::class, 'delete'])->name('borrar.doctor');


Route::delete('/medicamentos/{id}', [MedicamentoController::class, 'delete'])->name('borrar.medicamento');
// En routes/web.php o routes/api.php
Route::get('/test-log', function () {
    Log::info('Prueba de logging exitoso');
    return 'Logging probado';
});

Route::post('/log-failed-login', [LoginController::class, 'logFailedLogin']);


Route::get('/logs', [LogFileController::class, 'index'])->name('logs.index');

Route::post('/especialidades/eliminar', [EspecialidadController::class, 'delete'])->name('eliminar.especialidad');

// web.php
Route::get('/doctor', [DoctorController::class, 'create'])->name('doctor.create');


Route::post('/doctor/save', [DoctorController::class, 'save'])->name('doctor.save');
Route::delete('/doctor/delete/{id}', [DoctorController::class, 'destroy'])->name('doctor.delete');
Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');

Route::delete('/doctor/delete/{id}', [DoctorController::class, 'delete'])->name('doctor.delete');

Route::resource('pacientes', PacienteController::class);
Route::resource('pacientes', PacienteController::class);

Route::get('/pacientes/create', [PacienteController::class, 'index'])->name('pacientes.create');
Route::get('/pacientes', [PacienteController::class, 'list'])->name('pacientes.index');
Route::post('/pacientes', [PacienteController::class, 'save'])->name('guardar.paciente');
Route::delete('/pacientes/{id}', [PacienteController::class, 'delete'])->name('pacientes.destroy');
// routes/web.php
Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes');
Route::get('/medicamentos', [MedicamentoController::class, 'list'])->name('medicamentos');
Route::post('/medicamento/save', [MedicamentoController::class, 'save'])->name('medicamento.save');
// Otros routes según sea necesario


Route::get('/medicamentos', [MedicamentoController::class, 'list'])->name('medicamentos');
Route::get('/medicamentos/{id}', [MedicamentoController::class, 'index']); // Show medicamento
Route::post('/medicamentos', [MedicamentoController::class, 'save']); // Save medicamento
Route::delete('/medicamentos/{id}', [MedicamentoController::class, 'delete']); // Delete medicamento



// En web.php
Route::delete('/citas/{id}', [CitasController::class, 'destroy'])->name('citas.destroy');

// Ruta para obtener los datos de un paciente
Route::get('/api/pacientes/{id}', [PacienteController::class, 'show']);

// Ruta para actualizar los datos de un paciente
Route::put('/api/pacientes/{id}', [PacienteController::class, 'update']);

// web.php
Route::get('/pacientes', [PacienteController::class, 'list'])->name('pacientes');




// Ruta para mostrar el formulario de autorización
Route::get('/citas/{id}/authorize', [AutorizarController::class, 'showForm'])->name('citas.autorizar');

// Ruta para guardar cita autorizada o denegada
Route::post('/citas/{id}/authorize', [AutorizarController::class, 'guardarCita'])->name('guardar.cita');

// Ruta para obtener doctores según especialidad
Route::post('/fetch-doctores', [AutorizarController::class, 'fetchDoctores'])->name('fetch.doctores');

// Ruta para mostrar formulario de denegación
Route::get('/citas/{id}/denegar', [AutorizarController::class, 'showDenegacionForm'])->name('citas.denegar');


// En routes/web.php o routes/api.php
Route::post('/pacientes', [PacienteController::class, 'save'])->name('pacientes.store');


Route::post('/auth/google', [AuthController::class, 'googleLogin']);
// En routes/web.php

Route::delete('/medicamento/borrar/{id}', [MedicamentoController::class, 'delete'])->name('borrar.medicamento');
