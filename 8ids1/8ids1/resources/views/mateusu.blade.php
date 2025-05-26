@extends('adminlte::page')

@section('title', 'Agregar Material Usados')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Agregar Material Usados</h1>
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
                        Formulario de Material Usados
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.mateusu') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $mateusu->id }}">
                            <div class="mb-3">
                                <label for="id_cita" class="form-label">Cita</label>
                                <select class="form-control" id="id_cita" name="id_cita" required>
                                    @foreach ($citas as $cita)
                                        <option value="{{ $cita->id }}">{{ $cita->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_mate" class="form-label">Materiales:</label>
                                <select class="form-control" id="id_mate" name="id_mate" required>
                                    @foreach ($materiales as $material)
                                        <option value="{{ $material->id }}">{{ $material->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="canti" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="canti" name="canti" value="{{ $mateusu->canti }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="unidad" class="form-label">Unidades:</label>
                                <input type="number" class="form-control" id="unidad" name="unidad" value="{{$mateusu->unidad}}" required>
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
