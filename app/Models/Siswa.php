<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'kelas',
        'alamat',
        'nama_wali',
        'no_hp_wali',
        'status_aktif',
    ];

    public function laporanObservasis(): HasMany
    {
        return $this->hasMany(LaporanObservasi::class, 'siswa_id');
    }

    public function kelasDetail(): BelongsTo
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}
}
