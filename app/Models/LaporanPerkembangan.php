<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPerkembangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_perkembangans';

    protected $fillable = [
        'siswa_id',
        'periode',
        'perkembangan_akademik',
        'perkembangan_karakter',
        'wali_kelas',
        'tanggal_laporan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
