<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggarans';

    protected $fillable = [
        'siswa_id',
        'jenis_pelanggaran',
        'poin',
        'tanggal_pelanggaran',
        'keterangan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function suratPanggilans(): HasMany
    {
        return $this->hasMany(SuratPanggilan::class, 'pelanggaran_id');
    }
}
