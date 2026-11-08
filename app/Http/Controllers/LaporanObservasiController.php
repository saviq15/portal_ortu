<?php

namespace App\Http\Controllers;

use App\Models\LaporanObservasi;
use Illuminate\Http\Request;

class LaporanObservasiController extends Controller
{
    public function index()
    {
        $laporan = LaporanObservasi::with('siswa')->latest()->paginate(10);
        return response()->json($laporan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal_observasi' => 'required|date',
            'aspek_pengamatan' => 'required|string',
            'catatan_perkembangan' => 'required|string',
            'guru_pencatat' => 'required|string|max:255',
        ]);

        $laporan = LaporanObservasi::create($validated);

        return response()->json([
            'message' => 'Laporan observasi berhasil ditambahkan',
            'data' => $laporan->load('siswa')
        ], 201);
    }

    public function show(LaporanObservasi $laporanObservasi)
    {
        return response()->json($laporanObservasi->load('siswa'));
    }

    public function update(Request $request, LaporanObservasi $laporanObservasi)
    {
        $validated = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'tanggal_observasi' => 'sometimes|required|date',
            'aspek_pengamatan' => 'sometimes|required|string',
            'catatan_perkembangan' => 'sometimes|required|string',
            'guru_pencatat' => 'sometimes|required|string|max:255',
        ]);

        $laporanObservasi->update($validated);

        return response()->json([
            'message' => 'Laporan observasi berhasil diperbarui',
            'data' => $laporanObservasi->load('siswa')
        ]);
    }

    public function destroy(LaporanObservasi $laporanObservasi)
    {
        $laporanObservasi->delete();

        return response()->json([
            'message' => 'Laporan observasi berhasil dihapus'
        ]);
    }
}
