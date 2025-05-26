@extends('adminlte::page')

@section('title', 'Agregar Cita')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Agregar Cita</h1>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Formulario de Cita
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.cita') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cita->id }}">
                            <div class="mb-3">
                                <label for="id_paciente" class="form-label">Agregar Paciente:</label>
                                <select class="form-control" id="id_paciente" name="id_paciente" required>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fech" class="form-label">Fecha de cita:</label>
                                <input type="date" class="form-control" id="fech" name="fech" value="{{ $cita->fech }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="obser" class="form-label">Observaciones:</label>
                                <input type="text" class="form-control" id="obser" name="obser" value="{{ $cita->obser }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <input type="text" class="form-control" id="estado" name="estado" value="{{ $cita->estado }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_consul" class="form-label">Consultorio:</label>
                                <select class="form-control" id="id_consul" name="id_consul" required>
                                    @foreach ($consultorios as $consultorio)
                                        <option value="{{ $consultorio->id }}">{{ $consultorio->numero }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_doc" class="form-label">Doctor:</label>
                                <select class="form-control" id="id_doc" name="id_doc" required>
                                    @foreach ($doctores as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_espe" class="form-label">Especialidad:</label>
                                <select class="form-control" id="id_espe" name="id_espe" required>
                                    @foreach ($especialidades as $especialidad)
                                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        body {
            background-color: #f8fafc;
        }
        .alert-primary {
            background-color: #007bff;
            color: #ffffff;
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-primary {
            margin-top: 10px;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
