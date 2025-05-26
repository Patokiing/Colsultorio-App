@extends('adminlte::page')

@section('title', 'Lista de Materiales')

@section('content_header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Materiales</h1>
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
                        Material
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Fecha Caducidad</th>
                                    <th>Existencia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiales as $material)
                                    <tr>
                                        <td>{{ $material->id }}</td>
                                        <td>{{ $material->codigo }}</td>
                                        <td>{{ $material->descrip }}</td>
                                        <td>{{ $material->pres }}</td>
                                        <td>{{ $material->fec_cad }}</td>
                                        <td>{{ $material->exis }}</td>
                                        <td>
                                            <a href="{{ route('nueva.material', ['id' => $material->id]) }}" class="btn btn-primary">Editar</a>
                                            <form action="{{ route('borrar.material') }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $material->id }}">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este material?');">Eliminar</button>
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
        .btn-danger {
            margin-left: 5px;
       
        }
        </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop