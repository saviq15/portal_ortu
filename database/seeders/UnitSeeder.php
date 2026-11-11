<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataUnit = [
            ['nama_unit' => 'SMK Yayasan', 'kode_unit' => 'SMK'],
            ['nama_unit' => 'Madrasah Ibtidaiyah', 'kode_unit' => 'MI'],
            ['nama_unit' => 'Madrasah Tsanawiyah', 'kode_unit' => 'MTS'],
            ['nama_unit' => 'Madrasah Aliyah', 'kode_unit' => 'MA'],
            ['nama_unit' => 'Taman Kanak-Kanak', 'kode_unit' => 'TK'],
            ['nama_unit' => 'Pondok Pesantren', 'kode_unit' => 'PONPES'],
            ['nama_unit' => 'Tata Usaha Pusat', 'kode_unit' => 'TU_PUSA'],
            ['nama_unit' => 'Baitul Maal wat Tamwil', 'kode_unit' => 'BMT_YAY'],
            ['nama_unit' => 'Unit Sarana & Prasarana', 'kode_unit' => 'SARPRAS'],
            ['nama_unit' => 'Asrama Putra & Putri', 'kode_unit' => 'ASRAMA'],
        ];

        foreach ($dataUnit as $unit) {
            Unit::create($unit);
        }
    }
}
