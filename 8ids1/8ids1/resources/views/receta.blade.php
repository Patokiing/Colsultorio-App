@extends('adminlte::page')

@section('title', 'Receta')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Receta para Cita #{{ $atencionCita->cita_id }}</h1>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">Receta</div>

                    <div class="card-body">
                        <p><strong>Observaciones del Doctor:</strong></p>
                        <p>{{ $atencionCita->observaciones_doctor }}</p>

                        @if ($cita->medicamentos->isNotEmpty())
                            <h3>Medicamentos Recetados:</h3>
                            <ul>
                                @foreach ($cita->medicamentos as $medicamento)
                                    <li>
                                        {{ $medicamento->descripcion }} - 
                                        Cantidad: {{ $medicamento->pivot->cantidad }}, 
                                        Frecuencia: {{ $medicamento->pivot->frecuencia }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No se han recetado medicamentos.</p>
                        @endif

                        <a href="{{ route('citas') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
