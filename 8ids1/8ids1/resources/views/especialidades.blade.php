@extends('adminlte::page')

@section('title', 'Lista de Especialidades')

@section('content_header')
   
@stop

@section('content')
<!-- Contenedor principal que cubre toda la página -->
<div class="full-page-container">
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Especialidades</h1>
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

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Especialidades</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Especialidad</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidades as $especialidad)
                                    <tr>
                                        <td>{{ $especialidad->id }}</td>
                                        <td>{{ $especialidad->nombre }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('nueva.especialidad', ['id' => $especialidad->id]) }}" class="btn btn-primary">Editar</a>
                                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $especialidad->id }}">Eliminar</button>
                                            <!-- Formulario para eliminar especialidad -->
                                            <form id="delete-form-{{ $especialidad->id }}" action="{{ route('borrar.especialidad') }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $especialidad->id }}">
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

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmación de Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta especialidad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div></div>
@stop

@section('css')
    <style>
             /* Estilo para el contenedor que cubre toda la página */
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
        body {
            background-color: #ffffff;
        }
        .alert-primary {
            background-color: #ffffff;
            color: black;
        }
        .card-header {
            background-color: #ffffff;
            color: #ffffff;
        }
        .text-center {
            text-align: center;
        }
        .btn-delete {
            cursor: pointer;
        }
        .card{
            background-color: #ffffff;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteForm = null;

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const id = button.getAttribute('data-id');
                    deleteForm = document.getElementById('delete-form-' + id);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás recuperar esta especialidad después de eliminarla!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminarla',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteForm.submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
