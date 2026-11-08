<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return KelasResource::collection(Kelas::withCount('siswas')->latest()->paginate(10));
    }

    public function store(StoreKelasRequest $request)
    {
        $kelas = Kelas::create($request->validated());

        LogAktivitasHelper::catat('Menambahkan kelas baru: ' . $kelas->nama_kelas, 'Master Data', 'Tingkat: ' . $kelas->tingkat);

        return response()->json([
            'message' => 'Data kelas berhasil ditambahkan',
            'data' => new KelasResource($kelas)
        ], 201);
    }

    public function show(Kelas $kela)
    {
        return response()->json($kela->load('siswas', 'waliKelas'));
    }

    public function update(UpdateKelasRequest $request, Kelas $kela)
    {
        $kela->update($request->validated());

        LogAktivitasHelper::catat('Memperbarui data kelas: ' . $kela->nama_kelas, 'Master Data', 'ID: ' . $kela->id);

        return response()->json([
            'message' => 'Data kelas berhasil diperbarui',
            'data' => new KelasResource($kela)
        ]);
    }

    public function destroy(Kelas $kela)
    {
        $nama = $kela->nama_kelas;
        $kela->delete();

        LogAktivitasHelper::catat('Menghapus data kelas: ' . $nama, 'Master Data', 'ID: ' . $kela->id);

        return response()->json([
            'message' => 'Data kelas berhasil dihapus'
        ]);
    }
}
