<?php

namespace Database\Seeders;

use App\Models\Staf;
use Illuminate\Database\Seeder;

class StafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataStaf = [
            [
                'nama_staf' => 'Dr. H. Ahmad Sudrajat, M.Pd.',
                'nip' => '197503122003121002',
                'jabatan' => 'Kepala Sekolah SMK',
            ],
            [
                'nama_staf' => 'Siti Aminah, S.Pd.I.',
                'nip' => '198208152009042001',
                'jabatan' => 'Kepala Sekolah MI',
            ],
            [
                'nama_staf' => 'Budi Raharjo, S.Kom.',
                'nip' => '198811232015031005',
                'jabatan' => 'Waka Kurikulum',
            ],
            [
                'nama_staf' => 'Dewi Lestari, S.E.',
                'nip' => null, // Contoh NIP kosong (nullable) untuk staf honorer/yayasan
                'jabatan' => 'Bendahara Yayasan',
            ],
            [
                'nama_staf' => 'Eko Prasetyo, S.Pd.',
                'nip' => '199004052020121003',
                'jabatan' => 'Guru Pengajar',
            ],
        ];

        foreach ($dataStaf as $staf) {
            Staf::create($staf);
        }
    }
}
