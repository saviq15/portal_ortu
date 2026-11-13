<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Staf;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Admin & Initials
        $user = Auth::user(); 
        $adminName = $user?->name ?? 'Admin Yayasan';

        // 2. Ambil Data Tahun Ajaran Riil (Fallback jika database kosong)
        $activeYear = TahunAjaran::where('is_active', true)->first();
        $tahunAjaran = $activeYear 
            ? "{$activeYear->year} {$activeYear->semester}" 
            : '-';

        // 3. Statistik Utama (Riil dari Database)
        $totalUnit  = Unit::count();
        $totalStaf = Staf::count();
        $usersTidakTerhubung = User::query()
            ->whereIn('role', ['guru', 'wali_kelas'])
            ->whereDoesntHave('staf')
            ->count();

        $totalPendidikStaf = $totalStaf + $usersTidakTerhubung;
        $totalSiswa = Siswa::count(); 

        // Classify students from the existing free-text class field.
        $siswaMi = 0;
        $siswaSmk = 0;
        $siswaBelumDikelompokkan = 0;

        foreach (Siswa::query()->pluck('kelas') as $kelas) {
            $kelas = mb_strtoupper((string) $kelas);

            if (preg_match('/\b(XII|XI|X)\b/', $kelas)) {
                $siswaSmk++;
            } elseif (preg_match('/\b[1-6]\b/', $kelas)) {
                $siswaMi++;
            } else {
                $siswaBelumDikelompokkan++;
            }
        }

        $versi = '2.4.0';

        return view('admin.dashboard', compact(
            'adminName', 'tahunAjaran', 'totalUnit', 'totalPendidikStaf',
            'totalSiswa', 'siswaSmk', 'siswaMi', 'siswaBelumDikelompokkan', 'versi'
        ));
    }
}
