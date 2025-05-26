@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Guardar Medicamento Recetado</h1>
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
                    <div class="card-header bg-primary text-white">Formulario</div>
                    <div class="card-body">
                        <form action="{{ route('guardar.medirece') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $medirece->id }}">
                            <div class="mb-3">
                                <label for="id_cit" class="form-label">Cita</label>
                                <select class="form-control" id="id_cit" name="id_cit" required>
                                    @foreach ($citas as $cita)
                                        @if($cita->id)
                                            <option value="{{ $cita->id }}">{{ $cita->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_medi" class="form-label">Medicamento:</label>
                                <select class="form-control" id="id_medi" name="id_medi" required>
                                    @foreach ($medicamentos as $medicamento)
                                        @if($medicamento->id)
                                            <option value="{{ $medicamento->id }}">{{ $medicamento->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="caant" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="caant" name="caant" value="{{ $medirece->caant }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="uni" class="form-label">Unidades:</label>
                                <input type="number" class="form-control" id="uni" name="uni" value="{{$medirece->uni}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="cada" class="form-label">Cada hora:</label>
                                <input type="text" class="form-control" id="cada" name="cada" value="{{$medirece->cada}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="pordias" class="form-label">Por cuantos días:</label>
                                <input type="text" class="form-control" id="pordias" name="pordias" value="{{$medirece->pordias}}" required>
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
            margin-right: 5px;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
