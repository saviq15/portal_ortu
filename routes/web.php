<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 
// Route untuk melihat Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin/kelas', function () {
    return view('admin.kelas');
});
Route::get('/admin/pengguna', fn () => view('admin.pengguna'));
Route::get('/admin/tahun-ajaran', fn () => view('admin.tahun-ajaran'));



// Route untuk melihat Dashboard Guru
Route::get('/guru/dashboard', fn () => view('guru.dashboard'));
Route::get('/guru/jadwal-mengajar', fn () => view('guru.jadwal-mengajar'));
Route::get('/guru/input-nilai', fn () => view('guru.input-nilai'));
Route::get('/guru/penilaian-sikap', fn () => view('guru.penilaian-sikap'));
Route::get('/guru/riwayat-jurnal', fn () => view('guru.riwayat-jurnal'));
Route::get('/guru/profil-pengguna', fn () => view('guru.profil-pengguna'));


// Route untuk melihat Dashboard TU
Route::get('/tu/dashboard', fn () => view('tu.dashboard'));
Route::get('/tu/transaksi-pembayaran', fn () => view('tu.transaksi-pembayaran'));
Route::get('/tu/rekapitulasi-keuangan', fn () => view('tu.rekapitulasi-keuangan'));
Route::get('/tu/profil-pengguna', fn () => view('tu.profil-pengguna'));


// Route untuk melihat Dashboard wali murid
Route::get('/wali/dashboard', fn () => view('wali-murid.dashboard'));
Route::get('/wali/rapor-akademik', fn () => view('wali-murid.rapor-akademik'));
Route::get('/wali/kbm-mingguan', fn () => view('wali-murid.kbm-mingguan'));
Route::get('/wali/jurnal-sikap', fn () => view('wali-murid.jurnal-sikap'));
Route::get('/wali/tagihan-pembayaran', fn () => view('wali-murid.tagihan-pembayaran'));
Route::get('/wali/profil-pengguna', fn () => view('wali-murid.profil-pengguna'));