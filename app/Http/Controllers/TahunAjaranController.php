<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $activeYear = TahunAjaran::query()->where('is_active', true)->first();
        $tahunAjaran = $activeYear
            ? "{$activeYear->year} {$activeYear->semester}"
            : '-';
        $periods = TahunAjaran::query()
            ->orderByDesc('year')
            ->orderBy('semester')
            ->paginate(3);
        $periodRows = $periods->getCollection()->map(fn (TahunAjaran $period) => [
            'tahun' => $period->year,
            'semester' => $period->semester,
            'status' => $period->is_active ? 'Aktif' : '-',
        ])->values();

        return view('admin.tahun-ajaran', compact('tahunAjaran', 'periods', 'periodRows'));
    }
}
