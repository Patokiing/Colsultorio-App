@extends('adminlte::page')

@section('title', 'Lista de Medicamentos')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Medicamentos Recetados</h1>
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
                    <div class="card-header bg-primary text-white">Medicamento Recetado</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cita</th>
                                    <th>Medicamento</th>
                                    <th>Cantidad</th>
                                    <th>Unidades</th>
                                    <th>Cada</th>
                                    <th>Por Días</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiales_recetado as $medirece)
                                    <tr>
                                        <td>{{ $medirece->id }}</td>
                                        <td>{{ $medirece->id_cit }}</td>
                                        <td>{{ $medirece->id_medi }}</td>
                                        <td>{{ $medirece->caant }}</td>
                                        <td>{{ $medirece->uni }}</td>
                                        <td>{{ $medirece->cada }}</td>
                                        <td>{{ $medirece->pordias }}</td>
                                        <td>
                                            <a href="{{ route('nueva.medirece', ['id' => $medirece->id]) }}" class="btn btn-primary">Editar</a>
                                            <form action="{{ route('borrar.medirece') }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $medirece->id }}">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta especialidad?');">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
