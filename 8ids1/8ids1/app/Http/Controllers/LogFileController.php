<?php

// app/Http/Controllers/LogFileController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LogFileController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');
        if (!file_exists($logFile)) {
            return view('logs', ['logs' => [], 'error' => 'Archivo de log no encontrado.']);
        }

        $logs = array_slice(file($logFile), -100); // Obtener las últimas 100 líneas
        return view('logs', ['logs' => $logs]);
    }
}
