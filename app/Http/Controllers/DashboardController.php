<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Staf;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Admin & Initials
        $user = Auth::user(); 
        $adminName = $user ? $user->name : 'Admin Yayasan';
        $adminRole = $user ? $user->role_name : 'Super Administrator';
        
        $initials = collect(explode(' ', $adminName))
            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
            ->take(2)
            ->implode('');

        // 2. Ambil Data Tahun Ajaran Riil (Fallback jika database kosong)
        $activeYear = TahunAjaran::where('is_active', true)->first();
        $tahunAjaran = $activeYear 
            ? "{$activeYear->tahun} {$activeYear->semester}" 
            : '2026/2027 Ganjil';

        // 3. Statistik Utama (Riil dari Database)
        $totalUnit  = Unit::count();
        $totalStaf  = Staf::count();
        $totalSiswa = Siswa::count(); 

        // 4. HITUNG DINAMIS DIRECT TANPA JOINT/RELASI KELAS_ID
        // Menggunakan query LIKE langsung pada kolom 'kelas' tipe string di tabel siswas
        $siswaSmk = Siswa::where('kelas', 'LIKE', '%SMK%')->count();
        $siswaMi  = Siswa::where('kelas', 'LIKE', '%MI%')->count();
        
        $versi = '2.4.0';

        return view('admin.dashboard', compact(
            'adminName', 'adminRole', 'initials', 'tahunAjaran',
            'totalUnit', 'totalStaf', 'totalSiswa', 'siswaSmk', 'siswaMi', 'versi'
        ));
    }
}
