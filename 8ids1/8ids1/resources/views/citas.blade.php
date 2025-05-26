@extends('adminlte::page')

@section('title', 'Lista de Citas')

@section('content_header')

@stop

@section('content')
<!-- Contenedor principal que cubre toda la página -->
<div class="full-page-container">
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center mb-4" role="alert">
                    <h1 class="mb-0">Lista de Citas</h1>
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

                @if (session('show_receta'))
                    <div class="alert alert-info">
                        Se ha atendido la cita. <a href="{{ route('ver.receta', ['id' => session('show_receta')]) }}" class="btn btn-info">Ver Receta</a>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">Citas</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Especialidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->id }}</td>
                                        <td>{{ $cita->fech }}</td>
                                        <td>{{ $cita->especialidad ? $cita->especialidad->nombre : '' }}</td>
                                        <td>{{ $cita->estado }}</td>
                                        <td>
                                            <a href="{{ route('autorizar.cita', ['id' => $cita->id]) }}" class="btn btn-primary">Autorizar</a>
                                            <a href="{{ route('denegar.cita', ['id' => $cita->id]) }}" class="btn btn-warning">Denegar</a>
                                            <button class="btn btn-danger" onclick="confirmDelete('{{ $cita->id }}')">Eliminar</button>
                                            <form id="delete-form-{{ $cita->id }}" action="{{ route('borrar.cita') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $cita->id }}">
                                            </form>
                                            @if ($cita->estado == 'Autorizada')
                                                <a href="{{ route('atender.cita', ['id' => $cita->id]) }}" class="btn btn-success">Atender</a>
                                            @endif
                                            @if ($cita->estado == 'Atendida')
                                                <a href="{{ route('ver.receta', ['id' => $cita->id]) }}" class="btn btn-info">Ver Receta</a>
                                            @endif
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
        .btn-warning {
            margin-right: 5px;
        }
        .btn-danger {
            margin-left: 5px;
            margin-right: 5px;
        }
        .btn-success {
            margin-left: 5px;
        }
        .btn-info {
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
        function confirmDelete(citaId) {
            Swal.fire({
                title: '¿Estás seguro de que deseas eliminar esta cita?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + citaId).submit();
                }
            });
        }
    </script>
@stop
