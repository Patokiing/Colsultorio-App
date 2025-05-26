<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Figtree', sans-serif;
                background-image: url('/img/hospi1.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
            }

            header {
                position: absolute;
                top: 20px;
                right: 20px;
                display: flex;
                gap: 15px;
                z-index: 10;
            }

            header a {
                background-color: rgba(0, 0, 0, 0.5);
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                color: white;
                font-weight: 600;
                box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
            }

            header a:hover {
                background-color: rgba(0, 0, 0, 0.7);
            }

            .content {
                text-align: center;
                max-width: 600px;
                margin: auto;
                padding: 20px;
                background: rgba(0, 0, 0, 0.6);
                border-radius: 10px;
                box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3);
            }

            .content h1 {
                font-size: 3rem;
                margin-bottom: 20px;
            }

            footer {
                position: absolute;
                bottom: 20px;
                width: 100%;
                text-align: center;
                color: white;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <header>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrate</a>
                    @endif
                @endauth
            @endif
        </header>

        <div class="content">
            <h1>Bienvenido a MEDICONNECT</h1>
            <p>"Tu bienestar, nuestra misión"</p>
        </div>

        <footer>
            &copy; 2024 MEDICONNECT. Todos los derechos reservados.
        </footer>
    </body>
</html>
