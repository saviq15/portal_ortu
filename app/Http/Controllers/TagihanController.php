<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Resources\TagihanResource;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        return TagihanResource::collection(Tagihan::with('siswa')->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $tagihan = Tagihan::create($request->validated());

        LogAktivitasHelper::catat('Menambahkan tagihan: ' . $tagihan->nama_tagihan, 'Keuangan', 'Nominal: ' . $tagihan->nominal);

        return response()->json([
            'message' => 'Data tagihan berhasil ditambahkan',
            'data' => new TagihanResource($tagihan->load('siswa'))
        ], 201);
    }

    public function show(Tagihan $tagihan)
    {
        return response()->json($tagihan->load('siswa', 'pembayarans'));
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        $tagihan->update($request->validated());

        LogAktivitasHelper::catat('Memperbarui tagihan: ' . $tagihan->nama_tagihan, 'Keuangan', 'ID: ' . $tagihan->id);

        return response()->json([
            'message' => 'Data tagihan berhasil diperbarui',
            'data' => new TagihanResource($tagihan->load('siswa'))
        ]);
    }

    public function destroy(Tagihan $tagihan)
    {
        $nama = $tagihan->nama_tagihan;
        $tagihan->delete();

        LogAktivitasHelper::catat('Menghapus tagihan: ' . $nama, 'Keuangan', 'ID: ' . $tagihan->id);

        return response()->json([
            'message' => 'Data tagihan berhasil dihapus'
        ]);
    }
}
