<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WawancaraYayasan extends Model
{
    use HasFactory;

    protected $table = 'wawancara_yayasans';

    protected $fillable = [
        'siswa_id',
        'tanggal_wawancara',
        'pemberi_wawancara',
        'hasil_wawancara',
        'tindak_lanjut',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
