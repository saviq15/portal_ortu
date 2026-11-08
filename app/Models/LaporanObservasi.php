<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanObservasi extends Model
{
    use HasFactory;

    protected $table = 'laporan_observasis';

    protected $fillable = [
        'siswa_id',
        'tanggal_observasi',
        'aspek_pengamatan',
        'catatan_perkembangan',
        'guru_pencatat',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
