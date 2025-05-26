@extends('adminlte::page')

@section('title', 'Agregar Material')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Agregar Material</h1>
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
                        Formulario de Material
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.material') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $material->id }}">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código:</label>
                                <input type="text" id="codigo" name="codigo" class="form-control" value="{{ $material->codigo }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="descrip" class="form-label">Descripción:</label>
                                <input type="text" id="descrip" name="descrip" class="form-control" value="{{ $material->descrip }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="pres" class="form-label">Precio:</label>
                                <input type="text" id="pres" name="pres" class="form-control" value="{{ $material->pres }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="fec_cad" class="form-label">Fecha de Caducidad:</label>
                                <input type="date" id="fec_cad" name="fec_cad" class="form-control" value="{{ $material->fec_cad }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="exis" class="form-label">Existencia:</label>
                                <input type="number" id="exis" name="exis" class="form-control" value="{{ $material->exis }}" required>
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
        .form-control {
            margin-bottom: 15px;
        }
        @section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Agregar Material</h1>
                </div>
            </div>
        </div>
    </div>
@stop
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
