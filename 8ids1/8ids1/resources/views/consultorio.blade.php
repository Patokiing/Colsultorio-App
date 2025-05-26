@extends('adminlte::page')

@section('title', 'Agregar Consultorio')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Agregar Consultorio</h1>
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
                        <h4 class="mb-0">Formulario de Consultorio</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.consultorio') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $consultorio->id }}">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Número</label>
                                <input type="number" id="nombre" name="nombre" class="form-control" value="{{ $consultorio->numero }}" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
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
        .text-center {
            text-align: center;
        }
        .form-control {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
