<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagihanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_tagihan' => $this->nama_tagihan,
            'nominal' => (float) $this->nominal,
            'nominal_formatted' => 'Rp ' . number_format($this->nominal, 0, ',', '.'),
            'tenggat_waktu' => $this->tenggat_waktu,
            'status' => $this->status,
            'siswa' => new SiswaResource($this->whenLoaded('siswa')),
            'riwayat_pembayaran' => PembayaranResource::collection($this->whenLoaded('pembayarans')),
        ];
    }
}
