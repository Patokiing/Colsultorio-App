@extends('adminlte::page')

@section('title', 'Lista de Pacientes')

@section('content_header')
  
@stop

@section('content')
<!-- Contenedor principal que cubre toda la página -->
<div class="full-page-container">
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Pacientes</h1>
                </div>
            </div>
        </div>
    </div>
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
                        Pacientes
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td>{{ $paciente->id }}</td>
                                        <td>{{ $paciente->nombre }}</td>
                                        <td>{{ $paciente->ApPat }}</td>
                                        <td>{{ $paciente->ApMat }}</td>
                                        <td>
                                            <a href="{{ route('nueva.paciente', ['id' => $paciente->id]) }}" class="btn btn-primary">Editar</a>
                                            <button class="btn btn-danger" onclick="deletePaciente('{{ $paciente->id }}')">Eliminar</button>
                                            <form id="delete-form-{{ $paciente->id }}" action="{{ route('borrar.paciente') }}" method="POST" style="display:none;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $paciente->id }}">
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
    </div></div>
@stop

@section('css')
    <style>
        body {
            background-color: #f8fafc;
        }
        .alert-primary {
            background-color: #ffffff;
            color: black;
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
        .full-page-container {
            display: flex;
            flex-direction: column; /* Dispone los elementos verticalmente */
            min-height: 100vh; /* Cubre toda la altura de la ventana */
            background: url('{{ asset('img/hospi.jpg') }}') no-repeat center center; /* Ruta a la imagen de fondo */
            background-size: cover; /* Asegura que la imagen cubra todo el contenedor */
            padding: 20px; /* Espacio alrededor del contenedor principal */
            box-shadow: 1px 3px 37px 18px rgba(116,219,214,1); /* Sombra */
            border-radius: 8px; /* Bordes redondeados */
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletePaciente(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@stop
