<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\UpdateSiswaRequest;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return SiswaResource::collection(Siswa::latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $siswa = Siswa::create($request->validated());

        LogAktivitasHelper::catat(
            'Menambahkan data siswa baru: ' . $siswa->nama_lengkap,
            'Kesiswaan',
            'NIS: ' . $siswa->nis
        );

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => new SiswaResource($siswa)
        ], 201);
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('laporanObservasis');
        return response()->json($siswa);
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->validated());

        LogAktivitasHelper::catat(
            'Memperbarui data siswa: ' . $siswa->nama_lengkap, 
            'Kesiswaan', 
            'ID: ' . $siswa->id
        );

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui',
            'data' => new SiswaResource($siswa)
        ]);
    }

    public function destroy(Siswa $siswa)
    {
        $nama = $siswa->nama_lengkap;
        $siswa->delete();

        LogAktivitasHelper::catat(
            'Menghapus data siswa: ' . $nama, 
            'Kesiswaan', 
            'ID: ' . $siswa->id
        );

        return response()->json([
            'message' => 'Data siswa berhasil dihapus'
        ]);
    }
}
