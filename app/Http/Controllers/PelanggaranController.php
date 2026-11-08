<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\StorePelanggaranRequest;
use App\Http\Requests\UpdatePelanggaranRequest;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Pelanggaran::with('siswa')->latest()->paginate(10)
        ]);
    }

    public function store(StorePelanggaranRequest $request)
    {
        $pelanggaran = Pelanggaran::create($request->validated());

        LogAktivitasHelper::catat('Mencatat pelanggaran siswa ID: ' . $pelanggaran->siswa_id, 'Kedisiplinan', 'Poin: ' . $pelanggaran->poin);

        return response()->json([
            'message' => 'Data pelanggaran berhasil ditambahkan',
            'data' => $pelanggaran->load('siswa')
        ], 201);
    }

    public function show(Pelanggaran $pelanggaran)
    {
        return response()->json($pelanggaran->load('siswa', 'suratPanggilans'));
    }

    public function update(UpdatePelanggaranRequest $request, Pelanggaran $pelanggaran)
    {
        $pelanggaran->update($request->validated());

        LogAktivitasHelper::catat('Memperbarui catatan pelanggaran ID: ' . $pelanggaran->id, 'Kedisiplinan', 'Siswa ID: ' . $pelanggaran->siswa_id);

        return response()->json([
            'message' => 'Data pelanggaran berhasil diperbarui',
            'data' => $pelanggaran->load('siswa')
        ]);
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $id = $pelanggaran->id;
        $pelanggaran->delete();

        LogAktivitasHelper::catat('Menghapus catatan pelanggaran ID: ' . $id, 'Kedisiplinan', 'Log ID: ' . $id);

        return response()->json([
            'message' => 'Data pelanggaran berhasil dihapus'
        ]);
    }
}
