<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerkembangan;
use Illuminate\Http\Request;

class LaporanPerkembanganController extends Controller
{
    public function index()
    {
        $laporans = LaporanPerkembangan::with('siswa')->latest()->paginate(10);
        return response()->json($laporans);
    }

    public function store(Request $request)
    {
        $laporan = LaporanPerkembangan::create($request->validated());

        return response()->json([
            'message' => 'Laporan perkembangan siswa berhasil ditambahkan',
            'data' => $laporan->load('siswa')
        ], 201);
    }

    public function show(LaporanPerkembangan $laporanPerkembangan)
    {
        return response()->json($laporanPerkembangan->load('siswa'));
    }

    public function update(Request $request, LaporanPerkembangan $laporanPerkembangan)
    {
        $validated = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'periode' => 'sometimes|required|string|max:100',
            'perkembangan_akademik' => 'nullable|string',
            'perkembangan_karakter' => 'nullable|string',
            'wali_kelas' => 'sometimes|required|string|max:255',
            'tanggal_laporan' => 'sometimes|required|date',
        ]);

        $laporanPerkembangan->update($validated);

        return response()->json([
            'message' => 'Laporan perkembangan siswa berhasil diperbarui',
            'data' => $laporanPerkembangan->load('siswa')
        ]);
    }

    public function destroy(LaporanPerkembangan $laporanPerkembangan)
    {
        $laporanPerkembangan->delete();

        return response()->json([
            'message' => 'Laporan perkembangan siswa berhasil dihapus'
        ]);
    }
}
