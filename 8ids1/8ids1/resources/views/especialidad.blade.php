@extends('adminlte::page')

@section('title', 'Agregar Especialidad')

@section('content_header')
    <!-- Encabezado vacío si no es necesario -->
@stop

@section('content')
    <!-- Contenedor principal que cubre toda la página -->
    <div class="full-page-container">
        <!-- Contenedor para el formulario de Especialidad -->
        <div class="form-container">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Contenedor del texto "Nueva Especialidad" sin remarcado -->
                        <div class="alert alert-primary text-center mb-4" role="alert">
                            <h1 class="mb-0 text-title">Nueva Especialidad</h1>
                        </div>

                        <!-- Mensajes de error -->
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="custom-form-box">
                            <center><h4 class="mb-0">Especialidad</h4></center>
                            <form action="{{ route('guardar.especialidad') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $especialidad->id }}">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la especialidad:</label>
                                    <input type="text" id="nombre" placeholder="Ingresa una especialidad" name="nombre" class="input" value="{{ old('nombre', $especialidad->nombre) }}" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    <style>
        body {
            background-color: #f8fafc; /* Fondo similar al ejemplo de inicio */
        }
        .alert-primary {
            background-color: #ffffff; /* Color de fondo de alerta */
            color: black; /* Color del texto de alerta */
            border: none; /* Elimina el borde del contenedor de alerta */
            box-shadow: none; /* Elimina la sombra del contenedor de alerta */
        }

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

        /* Estilo para el contenedor del formulario */
        .form-container {
            margin: 0 auto;
            width: 50%;
            display: flex;
            flex-direction: column; /* Dispone los elementos verticalmente */
            align-items: center; /* Centra horizontalmente */
        }

        /* Estilo personalizado para el formulario */
        .custom-form-box {
            background-color: #ffffff; /* Fondo blanco */
            color: black; /* Texto negro */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 1px 3px 37px -7px rgba(0,0,0,1); /* Sombra ligera */
            width: 100%; /* Asegura que el formulario ocupe todo el ancho disponible dentro del contenedor */
            max-width: 600px; /* Limita el ancho máximo del formulario */
        }

        /* Estilo personalizado para el input */
        .input {
            border-radius: 10px;
            outline: 2px solid #65F3E4;
            border: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #e2e2e2;
            outline-offset: 3px;
            padding: 10px 1rem;
            transition: 0.25s;
            width: 100%; /* Ajusta el ancho del input al 100% del contenedor */
        }

        .input:focus {
            outline-offset: 5px;
            background-color: #fff;
        }

        button {
            width: 150px;
            height: 60px;
            border: 3px solid #65F3E4;
            border-radius: 45px;
            transition: all 0.3s;
            cursor: pointer;
            background: white;
            font-size: 1.2em;
            font-weight: 550;
            font-family: 'Montserrat', sans-serif;
        }

        button:hover {
            background: #65F3E4;
            color: black;
            font-size: 1.5em;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("nombre").addEventListener("input", function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
    });
});
</script>
@stop
