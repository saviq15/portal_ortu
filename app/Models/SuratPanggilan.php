<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPanggilan extends Model
{
    use HasFactory;

    protected $table = 'surat_panggilans';

    protected $fillable = [
        'siswa_id',
        'pelanggaran_id',
        'nomor_surat',
        'tanggal_panggilan',
        'waktu_panggilan',
        'keperluan',
        'status',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }
}
