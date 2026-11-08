<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi_siswas';

    protected $fillable = [
        'siswa_id',
        'nama_prestasi',
        'kategori',
        'tingkat',
        'peringkat',
        'tanggal_dicapai',
        'keterangan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
