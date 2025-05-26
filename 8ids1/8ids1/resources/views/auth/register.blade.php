@extends('adminlte::auth.register')

@section('css')
    <style>
        body.register-page {
            background: url('/img/hospi.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .register-box {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .register-logo a {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
        }

        .register-card-body {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .card-header h3 {
            color: #007bff;
            font-size: 1.5rem;
            text-align: center;
        }

        .card-footer a {
            color: #ffffff;
        }

        .card-footer a:hover {
            color: #007bff;
        }
    </style>
@endsection