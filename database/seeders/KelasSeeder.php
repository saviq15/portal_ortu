<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'X RPL 1',
            'tingkat' => 'X',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tahun_ajaran' => '2025/2026',
        ]);

        Kelas::create([
            'nama_kelas' => 'XI TKJ 1',
            'tingkat' => 'XI',
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'tahun_ajaran' => '2025/2026',
        ]);
    }
}
