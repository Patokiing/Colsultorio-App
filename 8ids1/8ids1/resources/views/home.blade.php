@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <!-- Contenedor principal que cubre toda la página -->
    <div class="full-page-container">
        <div class="welcome-container">
            <!-- Contenedor existente -->
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="custom-welcome-box text-center">
                            <h4>¡Bienvenido!</h4>
                            <p>Estamos encantados de tenerte aquí. Explora las opciones disponibles</p>
                        </div>

                        <!-- Nueva sección de visión y misión -->
                        <div class="vision-mission-box">
                            <h4>Visión</h4>
                            <p>Nuestra visión es ser el consultorio líder en atención médica integral, proporcionando servicios de calidad con un enfoque en la innovación y la empatía, mejorando la salud y el bienestar de nuestra comunidad.</p>
                            
                            <h4>Misión</h4>
                            <p>Nos comprometemos a ofrecer atención médica excepcional y personalizada a cada paciente, utilizando las últimas tecnologías y prácticas clínicas para garantizar el mejor cuidado posible. Trabajamos con integridad, dedicación y pasión para lograr una salud óptima para todos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            -webkit-box-shadow: 1px 3px 37px 18px rgba(116,219,214,1); /* Sombra para WebKit */
            -moz-box-shadow: 1px 3px 37px 18px rgba(116,219,214,1); /* Sombra para Firefox */
            box-shadow: 1px 3px 37px 18px rgba(116,219,214,1); /* Sombra estándar */
            border-radius: 8px; /* Bordes redondeados */
        }

        /* Estilo para el contenedor de bienvenida */
        .welcome-container {
            flex: 1; /* Permite que el contenedor de bienvenida ocupe el espacio restante */
            display: flex;
            flex-direction: column; /* Dispone los elementos verticalmente */
            align-items: center; /* Centra horizontalmente */
        }

        /* Estilos del contenedor existente */
        .custom-welcome-box {
            background-color: #ffffff; /* Fondo blanco */
            color: black; /* Texto negro */
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%; /* Asegura que el contenedor de bienvenida ocupe todo el ancho disponible */
        }

        .custom-welcome-box h4 {
            margin-bottom: 10px;
        }

        .custom-welcome-box p {
            margin: 0;
        }

        /* Estilos para la sección de visión y misión */
        .vision-mission-box {
            background-color: #ffffff; /* Fondo blanco para destacar el texto */
            color: #333333; /* Texto oscuro para buena legibilidad */
            padding: 20px;
            border-radius: 5px;
            -webkit-box-shadow: 1px 3px 37px -7px rgba(0,0,0,1); /* Sombra ligera para WebKit */
            -moz-box-shadow: 1px 3px 37px -7px rgba(0,0,0,1); /* Sombra ligera para Firefox */
            box-shadow: 1px 3px 37px -7px rgba(0,0,0,1); /* Sombra ligera estándar */
            margin-top: 20px;
            width: 100%; /* Asegura que el contenedor de visión y misión ocupe todo el ancho disponible */
        }

        .vision-mission-box h4 {
            color: #007bff; /* Color azul para los títulos */
            margin-bottom: 15px;
        }

        .vision-mission-box p {
            margin: 0;
            line-height: 1.6; /* Mejora la legibilidad del texto */
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
