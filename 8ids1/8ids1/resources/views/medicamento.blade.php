@extends('adminlte::page')

@section('title', 'Agregar Medicamento')

@section('content_header')

@stop

@section('content')
    <!-- Contenedor principal que cubre toda la página -->
    <div class="full-page-container">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary text-center mb-4" role="alert">
                        <h1 class="mb-0">Agregar Medicamento</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contenedor para el formulario de Medicamento -->
        <div class="form-container">
            <div class="custom-form-box">
                <center><h4 class="mb-0">Formulario de Medicamento</h4></center>
                <form action="{{ route('guardar.medicamento') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $medicamento->id }}">

                    <!-- Eliminar campo 'codigo' ya que no lo necesitamos -->
                    <div class="form-group">
                        <label for="descripcion">Nombre:</label>
                        <input type="text" id="descripcion" name="descripcion" class="input" value="{{ $medicamento->descripcion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" id="precio" name="precio" class="input" value="{{ $medicamento->precio }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_caducidad">Fecha de Caducidad:</label>
                        <input type="date" id="fecha_caducidad" name="fecha_caducidad" class="input" value="{{ $medicamento->fecha_caducidad }}" required>
                    </div>
                    <div class="form-group">
                        <label for="existencia">Existencia:</label>
                        <input type="number" id="existencia" name="existencia" class="input" value="{{ $medicamento->existencia }}" required>
                    </div>

                    <!-- Nuevo campo para seleccionar la especialidad -->
                    <div class="form-group">
                        <label for="especialidad_id">Especialidad:</label>
                        <select name="especialidad_id" id="especialidad_id" class="input" required>
                            <option value="">Seleccione una especialidad</option>
                            @foreach($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}" 
                                    @if($medicamento->especialidad_id == $especialidad->id) selected @endif>
                                    {{ $especialidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit">Guardar</button>
                    </div>
                </form>
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
            background-color: #ffffff;
            color: black;
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
        .form-container {
            margin: 0 auto;
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .custom-form-box {
            background-color: #ffffff;
            color: black;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 1px 3px 37px -7px rgba(0,0,0,1);
            width: 100%;
            max-width: 600px;
        }
        .input {
            border-radius: 10px;
            outline: 2px solid #65F3E4;
            border: 0;
            background-color: #e2e2e2;
            outline-offset: 3px;
            padding: 10px 1rem;
            transition: 0.25s;
            width: 100%;
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
@stop
