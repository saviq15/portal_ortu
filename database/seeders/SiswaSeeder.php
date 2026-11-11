<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nis' => '2025001',
            'nama_lengkap' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'kelas' => 'X RPL 1',
            'alamat' => 'Wonosobo, Central Java',
            'nama_wali' => 'Bapak Fauzi',
            'no_hp_wali' => '081234567890',
            'status_aktif' => 'aktif',
        ]);

        Siswa::create([
            'nis' => '2025002',
            'nama_lengkap' => 'Siti Aminah',
            'jenis_kelamin' => 'P',
            'kelas' => 'XI TKJ 1',
            'alamat' => 'Kalibeber, Wonosobo',
            'nama_wali' => 'Ibu Aminah',
            'no_hp_wali' => '089876543210',
            'status_aktif' => 'aktif',
        ]);
    }
}
