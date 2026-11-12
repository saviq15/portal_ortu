<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanPerkembanganController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratPanggilanController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WawancaraYayasanController;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 

/*
|--------------------------------------------------------------------------
| Tambahkan Rute Autentikasi Bagi Tamu Yang Belum Login
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']); //->middleware('throttle:5,1')
});


/*
|--------------------------------------------------------------------------
| Tambahkan Rute Autentikasi Bagi Pengguna / User Yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Tambahkan Middleware Pada Rute Admin (Dashboard View & Controller Data)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    //  SOLUSI: Gabungkan rute frontend dan backend ke Controller di sini
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Jalur rute lainnya tetap biarkan seperti ini:
    Route::get('/kelas', [KelasController::class, 'page'])->name('kelas.view');
    Route::get('/pengguna', [UserController::class, 'page'])->name('pengguna.view');
    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran');

    // Route Backend Controller
    Route::get('/data/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/data/pengguna', [UserController::class, 'index'])->name('pengguna.index');
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas');
});

// Route::get('/guru/dashboard', fn () => view('guru.dashboard'));
// Route::get('/guru/jadwal-mengajar', fn () => view('guru.jadwal-mengajar'));
// Route::get('/guru/input-nilai', fn () => view('guru.input-nilai'));
// Route::get('/guru/penilaian-sikap', fn () => view('guru.penilaian-sikap'));
// Route::get('/guru/riwayat-jurnal', fn () => view('guru.riwayat-jurnal'));
// Route::get('/guru/profil-pengguna', fn () => view('guru.profil-pengguna'));

/*
|--------------------------------------------------------------------------
| Tambahkan Middleware Pada Rute Guru / Wali Kelas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru,wali_kelas'])->prefix('guru')->name('guru.')->group(function () {
    // Route Frontend
    Route::get('/dashboard', fn () => view('guru.dashboard'))->name('dashboard');
    Route::get('/jadwal-mengajar', fn () => view('guru.jadwal-mengajar'))->name('jadwal-mengajar');
    Route::get('/input-nilai', fn () => view('guru.input-nilai'))->name('input-nilai');
    Route::get('/penilaian-sikap', fn () => view('guru.penilaian-sikap'))->name('penilaian-sikap');
    Route::get('/riwayat-jurnal', fn () => view('guru.riwayat-jurnal'))->name('riwayat-jurnal');
    Route::get('/profil-pengguna', fn () => view('guru.profil-pengguna'))->name('profil-pengguna');

    // Route Backend Controller
    Route::get('/data/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/data/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran');
    Route::get('/data/surat-panggilan', [SuratPanggilanController::class, 'index'])->name('surat-panggilan');
    Route::get('/data/laporan-perkembangan', [LaporanPerkembanganController::class, 'index'])->name('laporan-perkembangan');
    Route::get('/data/prestasi', [PrestasiSiswaController::class, 'index'])->name('prestasi');
});


// Route untuk melihat Dashboard TU
// Route::get('/tu/dashboard', fn () => view('tu.dashboard'));
// Route::get('/tu/transaksi-pembayaran', fn () => view('tu.transaksi-pembayaran'));
// Route::get('/tu/rekapitulasi-keuangan', fn () => view('tu.rekapitulasi-keuangan'));
// Route::get('/tu/profil-pengguna', fn () => view('tu.profil-pengguna'));

/*
|--------------------------------------------------------------------------
| Tambahkan Middleware Pada Rute Tata Usaha (TU) / Pihak Yayasan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pihak_yayasan'])->prefix('tu')->name('tu.')->group(function () {
    // Route Frontend
    Route::get('/dashboard', fn () => view('tu.dashboard'))->name('dashboard');
    Route::get('/transaksi-pembayaran', fn () => view('tu.transaksi-pembayaran'))->name('transaksi-pembayaran');
    Route::get('/rekapitulasi-keuangan', fn () => view('tu.rekapitulasi-keuangan'))->name('rekapitulasi-keuangan');
    Route::get('/profil-pengguna', fn () => view('tu.profil-pengguna'))->name('profil-pengguna');

    // Route Backend Controller
    Route::get('/data/tagihan', [TagihanController::class, 'index'])->name('tagihan');
    Route::get('/data/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/data/wawancara', [WawancaraYayasanController::class, 'index'])->name('wawancara');
});


// Route untuk melihat Dashboard wali murid
// Route::get('/wali/dashboard', fn () => view('wali-murid.dashboard'));
// Route::get('/wali/rapor-akademik', fn () => view('wali-murid.rapor-akademik'));
// Route::get('/wali/kbm-mingguan', fn () => view('wali-murid.kbm-mingguan'));
// Route::get('/wali/jurnal-sikap', fn () => view('wali-murid.jurnal-sikap'));
// Route::get('/wali/tagihan-pembayaran', fn () => view('wali-murid.tagihan-pembayaran'));
// Route::get('/wali/profil-pengguna', fn () => view('wali-murid.profil-pengguna'));

/*
|--------------------------------------------------------------------------
| Tambahkan Middleware Pada Rute Wali Murid / Orang Tua 
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:orang_tua'])->prefix('wali')->name('wali.')->group(function () {
    // Route Frontend
    Route::get('/dashboard', fn () => view('wali-murid.dashboard'))->name('dashboard');
    Route::get('/rapor-akademik', fn () => view('wali-murid.rapor-akademik'))->name('rapor-akademik');
    Route::get('/kbm-mingguan', fn () => view('wali-murid.kbm-mingguan'))->name('kbm-mingguan');
    Route::get('/jurnal-sikap', fn () => view('wali-murid.jurnal-sikap'))->name('jurnal-sikap');
    Route::get('/tagihan-pembayaran', fn () => view('wali-murid.tagihan-pembayaran'))->name('tagihan-pembayaran');
    Route::get('/profil-pengguna', fn () => view('wali-murid.profil-pengguna'))->name('profil-pengguna');

    // Route Backend Controller
    Route::get('/data/tagihan', [TagihanController::class, 'index'])->name('tagihan');
    Route::get('/data/laporan-perkembangan', [LaporanPerkembanganController::class, 'index'])->name('laporan-perkembangan');
});
