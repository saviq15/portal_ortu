<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return KelasResource::collection(Kelas::withCount('siswas')->latest()->paginate(10));
    }

    public function page()
    {
        $activeYear = TahunAjaran::query()->where('is_active', true)->first();
        $tahunAjaran = $activeYear
            ? "{$activeYear->year} {$activeYear->semester}"
            : '-';
        $units = Unit::query()
            ->whereIn('kode_unit', ['MI', 'SMK'])
            ->orderBy('nama_unit')
            ->get();
        $waliKelas = User::query()
            ->where('role', 'wali_kelas')
            ->orderBy('name')
            ->get(['id', 'name']);
        $knownClassNames = Kelas::query()
            ->pluck('nama_kelas')
            ->map(fn ($name) => mb_strtolower(trim($name)))
            ->flip()
            ->all();
        $jumlahSiswaPerKelas = [];

        foreach (Siswa::query()->pluck('kelas') as $namaKelasSiswa) {
            $normalizedName = mb_strtolower(trim((string) $namaKelasSiswa));

            if (array_key_exists($normalizedName, $knownClassNames)) {
                $jumlahSiswaPerKelas[$normalizedName] = ($jumlahSiswaPerKelas[$normalizedName] ?? 0) + 1;
            }
        }

        $kelas = Kelas::query()
            ->with('waliKelas')
            ->orderBy('id')
            ->paginate(4);

        $kelas->getCollection()->transform(function (Kelas $item) use ($units, $jumlahSiswaPerKelas) {
            $tingkat = mb_strtoupper(trim($item->tingkat));
            $unitCode = in_array($tingkat, ['X', 'XI', 'XII'], true)
                ? 'SMK'
                : (preg_match('/^[1-6]$/', $tingkat) ? 'MI' : null);
            $unit = $units->firstWhere('kode_unit', $unitCode);

            $item->setAttribute('unit_code', $unit?->kode_unit);
            $item->setAttribute('unit_pendidikan', $unit?->nama_unit ?? '-');
            $item->setAttribute('wali_kelas_nama', $item->waliKelas->first()?->name ?? '-');
            $normalizedName = mb_strtolower(trim($item->nama_kelas));
            $item->setAttribute(
                'jumlah_siswa',
                array_key_exists($normalizedName, $jumlahSiswaPerKelas)
                    ? $jumlahSiswaPerKelas[$normalizedName]
                    : '-'
            );

            return $item;
        });

        return view('admin.kelas', compact('kelas', 'units', 'waliKelas', 'tahunAjaran'));
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
