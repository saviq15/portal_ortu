<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;

class PrestasiSiswaController extends Controller
{
    public function index()
    {
        $prestasis = PrestasiSiswa::with('siswa')->latest()->paginate(10);
        return response()->json($prestasis);
    }

    public function store(Request $request)
    {
        $prestasi = PrestasiSiswa::create($request->validated());

        return response()->json([
            'message' => 'Data prestasi siswa berhasil ditambahkan',
            'data' => $prestasi->load('siswa')
        ], 201);
    }

    public function show(PrestasiSiswa $prestasiSiswa)
    {
        return response()->json($prestasiSiswa->load('siswa'));
    }

    public function update(Request $request, PrestasiSiswa $prestasiSiswa)
    {
        $validated = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'nama_prestasi' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|in:akademik,non_akademik,ekstrakurikuler',
            'tingkat' => 'sometimes|required|in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional',
            'peringkat' => 'nullable|string|max:50',
            'tanggal_dicapai' => 'sometimes|required|date',
            'keterangan' => 'nullable|string',
        ]);

        $prestasiSiswa->update($validated);

        return response()->json([
            'message' => 'Data prestasi siswa berhasil diperbarui',
            'data' => $prestasiSiswa->load('siswa')
        ]);
    }

    public function destroy(PrestasiSiswa $prestasiSiswa)
    {
        $prestasiSiswa->delete();

        return response()->json([
            'message' => 'Data prestasi siswa berhasil dihapus'
        ]);
    }
}
