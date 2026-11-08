<?php

namespace Database\Seeders;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogAktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        LogAktivitas::create([
            'user_id' => $admin ? $admin->id : null,
            'aktivitas' => 'Melakukan seeding data awal sistem',
            'modul' => 'Sistem',
            'ip_address' => '127.0.0.1',
            'detail' => 'Membuat arsitektur modular untuk inisialisasi data induk kelas, siswa, dan manajemen hak akses pengguna (multi-role user)..',
        ]);
    }
}
