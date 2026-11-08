<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
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
            'nis' => $this->nis,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            'kelas' => $this->kelas,
            'alamat' => $this->alamat,
            'nama_wali' => $this->nama_wali,
            'no_hp_wali' => $this->no_hp_wali,
            'laporan_observasi' => LaporanObservasiResource::collection($this->whenLoaded('laporanObservasis')),
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
