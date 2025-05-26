@extends('adminlte::page')

@section('title', 'Denegación de Cita')


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
                        <h5 class="mb-0">Formulario de Denegación de Cita</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.cita', ['id' => $cita->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>ID:</label>
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
                                <label for="obser">Observaciones:</label>
                                <textarea class="form-control" id="obser" name="obser" rows="4" required></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="action" value="denegar" class="btn btn-danger">Denegar</button>
                                <a href="{{ route('citas') }}" class="btn btn-primary">Atrás</a>
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
        .form-group p {
            margin-bottom: 0;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-bottom: 1px solid #dee2e6;
        }
        .btn {
            margin: 0 5px;
        }
    </style>
@stop

