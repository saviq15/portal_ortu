<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user:id,name,role')->latest()->paginate(20);
        return response()->json($logs);
    }

    public function show(LogAktivitas $logAktivita)
    {
        return response()->json($logAktivita->load('user'));
    }
}
