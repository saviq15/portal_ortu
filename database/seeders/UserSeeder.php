<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasX = Kelas::where('nama_kelas', 'X RPL 1')->first();
        $siswa1 = Siswa::where('nis', '2025001')->first();

        // Akun Admin
        User::create([
            'name' => 'Administrator Sistem',
            'username' => 'admin',
            'email' => 'admin@nurunalannur.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Akun Guru / Wali Kelas 
        User::create([
            'name' => 'Bapak Guru Wali',
            'username' => 'guru_walikelas',
            'email' => 'guru@nurunalannur.sch.id',
            'password' => Hash::make('password'),
            'role' => 'wali_kelas',
            'kelas_id' => $kelasX ? $kelasX->id : null,
        ]);

        // Akun Pihak Yayasan / Tata Usaha (TU)
        User::create([
            'name' => 'Pihak Yayasan Keuangan',
            'username' => 'yayasan',
            'email' => 'yayasan@nurunalannur.sch.id',
            'password' => Hash::make('password'),
            'role' => 'pihak_yayasan',
        ]);

        // Akun Orang Tua / Wali Murid 
        User::create([
            'name' => 'Wali Murid Ahmad Fauzi',
            'username' => 'wali_fauzi',
            'email' => 'wali@nurunalannur.sch.id',
            'password' => Hash::make('password'),
            'role' => 'orang_tua',
            'siswa_id' => $siswa1 ? $siswa1->id : null,
        ]);
    }
}
