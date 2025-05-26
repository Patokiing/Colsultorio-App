@extends('adminlte::page')

@section('title', 'Atender Cita')

@section('content_header')
    <h1>Atender Cita</h1>
@stop

@section('content')
    @if (session('status'))
        <div class="alert {{ session('status_class') }}">
            {{ session('status') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Formulario de Atención de Cita</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.atencion', ['id' => $cita->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>ID de Cita:</label>
                                <p>{{ $cita->id }}</p>
                            </div>
                            <div class="form-group">
                                <label>Fecha:</label>
                                <p>{{ $cita->fech }}</p>
                            </div>
                            <div class="form-group">
                                <label>Especialidad:</label>
                                <p>{{ $cita->especialidad ? $cita->especialidad->nombre : 'N/A' }}</p>
                            </div>
                            <div class="form-group">
                                <label for="observaciones_doctor">Observaciones del Doctor:</label>
                                <textarea class="form-control" id="observaciones_doctor" name="observaciones_doctor" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="medicamentos">Medicamentos</label>
                                @foreach($medicamentos as $medicamento)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="medicamento{{ $medicamento->id }}" name="medicamentos[{{ $medicamento->id }}][id]" value="{{ $medicamento->id }}">
                                        <label class="form-check-label" for="medicamento{{ $medicamento->id }}">{{ $medicamento->descripcion }}</label>
                                        <input type="number" class="form-control" name="medicamentos[{{ $medicamento->id }}][cantidad]" placeholder="Cantidad">
                                        <input type="text" class="form-control" name="medicamentos[{{ $medicamento->id }}][frecuencia]" placeholder="Frecuencia">
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('citas') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .alert {
            margin-top: 20px;
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            text-align: center;
        }
        .alert-primary {
            background-color: #007bff;
            color: #ffffff;
        }
        .alert-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-bottom: 1px solid #dee2e6;
        }
        .form-group p {
            margin-bottom: 0;
        }
        .form-control {
            margin-top: 5px;
        }
        .btn {
            margin: 0 5px;
        }
    </style>
@stop
