<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'tagihan_id',
        'nomor_transaksi',
        'tanggal_payaran',
        'jumlah_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'petugas_penerima',
    ];

    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }
}
