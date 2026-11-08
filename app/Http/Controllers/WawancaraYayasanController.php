<?php

namespace App\Http\Controllers;

use App\Models\WawancaraYayasan;
use Illuminate\Http\Request;

class WawancaraYayasanController extends Controller
{
    public function index()
    {
        $wawancaras = WawancaraYayasan::with('siswa')->latest()->paginate(10);
        return response()->json($wawancaras);
    }

    public function store(Request $request)
    {
        $wawancara = WawancaraYayasan::create($request->validated());

        return response()->json([
            'message' => 'Data wawancara yayasan berhasil ditambahkan',
            'data' => $wawancara->load('siswa')
        ], 201);
    }

    public function show(WawancaraYayasan $wawancaraYayasan)
    {
        return response()->json($wawancaraYayasan->load('siswa'));
    }

    public function update(Request $request, WawancaraYayasan $wawancaraYayasan)
    {
        $validated = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'tanggal_wawancara' => 'sometimes|required|date',
            'pemberi_wawancara' => 'sometimes|required|string|max:255',
            'hasil_wawancara' => 'sometimes|required|string',
            'tindak_lanjut' => 'nullable|string',
        ]);

        $wawancaraYayasan->update($validated);

        return response()->json([
            'message' => 'Data wawancara yayasan berhasil diperbarui',
            'data' => $wawancaraYayasan->load('siswa')
        ]);
    }

    public function destroy(WawancaraYayasan $wawancaraYayasan)
    {
        $wawancaraYayasan->delete();

        return response()->json([
            'message' => 'Data wawancara yayasan berhasil dihapus'
        ]);
    }
}
