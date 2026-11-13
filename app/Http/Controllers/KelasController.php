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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
            $item->setAttribute('wali_kelas_id', $item->waliKelas->first()?->id);
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
        $data = $request->validated();
        $tahunAjaran = TahunAjaran::query()->where('is_active', true)->value('year');

        if (!$tahunAjaran) {
            throw ValidationException::withMessages([
                'tahun_ajaran' => 'Tahun ajaran aktif belum tersedia. Tambahkan dan aktifkan tahun ajaran terlebih dahulu.',
            ]);
        }

        $attributes = $this->classAttributes($data['unit'], $data['nama_kelas'], $tahunAjaran);
        $kelas = DB::transaction(function () use ($attributes, $data) {
            $kelas = Kelas::create($attributes);
            User::query()
                ->whereKey($data['wali_kelas_id'])
                ->where('role', 'wali_kelas')
                ->update(['kelas_id' => $kelas->id]);

            return $kelas;
        });

        LogAktivitasHelper::catat('Menambahkan kelas baru: ' . $kelas->nama_kelas, 'Master Data', 'Tingkat: ' . $kelas->tingkat);

        return redirect()
            ->route('admin.kelas.view')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kela)
    {
        return response()->json($kela->load('siswas', 'waliKelas'));
    }

    public function update(UpdateKelasRequest $request, Kelas $kela)
    {
        $data = $request->validated();
        $tahunAjaran = TahunAjaran::query()->where('is_active', true)->value('year');

        if (!$tahunAjaran) {
            throw ValidationException::withMessages([
                'tahun_ajaran' => 'Tahun ajaran aktif belum tersedia. Tambahkan dan aktifkan tahun ajaran terlebih dahulu.',
            ]);
        }

        $attributes = $this->classAttributes($data['unit'], $data['nama_kelas'], $tahunAjaran);
        DB::transaction(function () use ($kela, $attributes, $data) {
            $waliKelasLama = $kela->waliKelas()->pluck('users.id');
            $kela->update($attributes);

            User::query()
                ->whereIn('id', $waliKelasLama)
                ->where('role', 'wali_kelas')
                ->update(['kelas_id' => null]);

            User::query()
                ->whereKey($data['wali_kelas_id'])
                ->where('role', 'wali_kelas')
                ->update(['kelas_id' => $kela->id]);
        });

        LogAktivitasHelper::catat('Memperbarui data kelas: ' . $kela->nama_kelas, 'Master Data', 'ID: ' . $kela->id);

        return redirect()
            ->route('admin.kelas.view')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        $nama = $kela->nama_kelas;
        $kela->delete();

        LogAktivitasHelper::catat('Menghapus data kelas: ' . $nama, 'Master Data', 'ID: ' . $kela->id);

        return redirect()
            ->route('admin.kelas.view')
            ->with('success', 'Data kelas berhasil dihapus.');
    }

    private function classAttributes(string $unit, string $namaKelas, string $tahunAjaran): array
    {
        if ($unit === 'mi' && preg_match('/\b([1-6])\b/', $namaKelas, $matches)) {
            return [
                'nama_kelas' => $namaKelas,
                'tingkat' => $matches[1],
                'jurusan' => null,
                'tahun_ajaran' => $tahunAjaran,
            ];
        }

        if ($unit === 'smk' && preg_match('/\b(XII|XI|X)\b/i', $namaKelas, $matches)) {
            $tingkat = mb_strtoupper($matches[1]);
            $jurusan = null;

            if (preg_match('/^\s*(?:XII|XI|X)\s+([A-Z0-9-]+)(?:\s+\d+)?\s*$/i', $namaKelas, $majorMatch)) {
                $majorCode = mb_strtoupper($majorMatch[1]);

                foreach (Kelas::query()->whereNotNull('jurusan')->get(['nama_kelas', 'jurusan']) as $knownClass) {
                    if (
                        preg_match('/^\s*(?:XII|XI|X)\s+([A-Z0-9-]+)(?:\s+\d+)?\s*$/i', $knownClass->nama_kelas, $knownMajorMatch)
                        && mb_strtoupper($knownMajorMatch[1]) === $majorCode
                    ) {
                        $jurusan = $knownClass->jurusan;
                        break;
                    }
                }
            }

            return [
                'nama_kelas' => $namaKelas,
                'tingkat' => $tingkat,
                'jurusan' => $jurusan,
                'tahun_ajaran' => $tahunAjaran,
            ];
        }

        throw ValidationException::withMessages([
            'nama_kelas' => $unit === 'mi'
                ? 'Nama kelas MI harus mencantumkan tingkat 1 sampai 6.'
                : 'Nama kelas SMK harus mencantumkan tingkat X, XI, atau XII.',
        ]);
    }
}
