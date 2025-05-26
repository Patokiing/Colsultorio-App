<!-- resources/views/logs.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Logs del Sistema</h1>

            @if (isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de Actividades</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Nivel</th>
                                    <th>Mensaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    @php
                                        // Asumimos que el formato del log es [fecha] [nivel] mensaje
                                        $parts = explode(' ', $log, 3);
                                        
                                        // Manejar el caso cuando $parts tiene menos de 3 elementos
                                        $date = isset($parts[0]) ? $parts[0] : 'Desconocido';
                                        $level = isset($parts[1]) ? explode(':', $parts[1])[0] : 'INFO';
                                        $message = isset($parts[2]) ? $parts[2] : 'Mensaje no disponible';
                                    @endphp
                                    <tr class="log-{{ strtolower($level) }}">
                                        <td>{{ $date }}</td>
                                        <td>{{ $level }}</td>
                                        <td>{{ $message }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .log-info { background-color: #d1ecf1; color: #0c5460; }
    .log-warning { background-color: #fff3cd; color: #856404; }
    .log-error { background-color: #f8d7da; color: #721c24; }
</style>
@endsection
