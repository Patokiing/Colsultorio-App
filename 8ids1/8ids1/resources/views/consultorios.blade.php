@extends('adminlte::page')

@section('title', 'Lista de Consultorios')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Consultorios</h1>
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
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Consultorios</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Consultorio</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultorios as $consultorio)
                                    <tr>
                                        <td>{{ $consultorio->id }}</td>
                                        <td>{{ $consultorio->numero }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('nueva.consultorio', ['id' => $consultorio->id]) }}" class="btn btn-primary">Editar</a>
                                            <form action="{{ route('borrar.consultorio') }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $consultorio->id }}">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este consultorio?');">Eliminar</button>
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
        .text-center {
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
