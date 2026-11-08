<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('tagihan.siswa')->latest()->paginate(10);
        return response()->json($pembayarans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'nomor_transaksi' => 'required|string|max:50|unique:pembayarans,nomor_transaksi',
            'tanggal_payaran' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|max:50',
            'bukti_pembayaran' => 'nullable|string',
            'petugas_penerima' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $pembayaran = Pembayaran::create($validated);

            // opsi otomatis update status tagihan jika dirasa perlu
            $tagihan = Tagihan::findOrFail($validated['tagihan_id']);
            $totalBayar = $tagihan->pembayarans()->sum('jumlah_bayar');
            
            if ($totalBayar >= $tagihan->jumlah_tagihan) {
                $tagihan->update(['status' => 'lunas']);
            }

            DB::commit();

            return response()->json([
                'message' => 'Pembayaran berhasil dicatat',
                'data' => $pembayaran->load('tagihan.siswa')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal mencatat pembayaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Pembayaran $pembayaran)
    {
        return response()->json($pembayaran->load('tagihan.siswa'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'tagihan_id' => 'sometimes|required|exists:tagihans,id',
            'nomor_transaksi' => 'sometimes|required|string|max:50|unique:pembayarans,nomor_transaksi,' . $pembayaran->id,
            'tanggal_payaran' => 'sometimes|required|date',
            'jumlah_bayar' => 'sometimes|required|numeric|min:0',
            'metode_pembayaran' => 'sometimes|required|string|max:50',
            'bukti_pembayaran' => 'nullable|string',
            'petugas_penerima' => 'sometimes|required|string|max:255',
        ]);

        $pembayaran->update($validated);

        return response()->json([
            'message' => 'Data pembayaran berhasil diperbarui',
            'data' => $pembayaran->load('tagihan.siswa')
        ]);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return response()->json([
            'message' => 'Data pembayaran berhasil dihapus'
        ]);
    }
}
