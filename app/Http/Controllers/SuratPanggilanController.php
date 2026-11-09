<?php

namespace App\Http\Controllers;

use App\Models\SuratPanggilan;
use Illuminate\Http\Request;

class SuratPanggilanController extends Controller
{
    public function index()
    {
        $surats = SuratPanggilan::with('siswa', 'pelanggaran')->latest()->paginate(10);
        return response()->json($surats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'pelanggaran_id' => 'nullable|exists:pelanggarans,id',
            'nomor_surat' => 'required|string|max:50|unique:surat_panggilans,nomor_surat',
            'tanggal_panggilan' => 'required|date',
            'waktu_panggilan' => 'required',
            'keperluan' => 'required|string',
            'status' => 'in:pending,hadir,tidak_hadir',
        ]);

        $suratPanggilan = SuratPanggilan::create($validated);

        return response()->json([
            'message' => 'Surat panggilan berhasil dibuat',
            'data' => $suratPanggilan->load('siswa', 'pelanggaran')
        ], 201);
    }

    public function show(SuratPanggilan $suratPanggilan)
    {
        return response()->json($suratPanggilan->load('siswa', 'pelanggaran'));
    }

    public function update(Request $request, SuratPanggilan $suratPanggilan)
    {
        $validated = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'pelanggaran_id' => 'nullable|exists:pelanggarans,id',
            'nomor_surat' => 'sometimes|required|string|max:50|unique:surat_panggilans,nomor_surat,' . $suratPanggilan->id,
            'tanggal_panggilan' => 'sometimes|required|date',
            'waktu_panggilan' => 'sometimes|required',
            'keperluan' => 'sometimes|required|string',
            'status' => 'in:pending,hadir,tidak_hadir',
        ]);

        $suratPanggilan->update($validated);

        return response()->json([
            'message' => 'Surat panggilan berhasil diperbarui',
            'data' => $suratPanggilan->load('siswa', 'pelanggaran')
        ]);
    }

    public function destroy(SuratPanggilan $suratPanggilan)
    {
        $suratPanggilan->delete();

        return response()->json([
            'message' => 'Surat panggilan berhasil dihapus'
        ]);
    }
}
