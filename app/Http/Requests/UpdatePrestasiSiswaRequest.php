<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestasiSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'siswa_id' => ['required', 'exists:siswas,id'],
            'nama_prestasi' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:akademik,non_akademik,ekstrakurikuler'],
            'tingkat' => ['required', 'in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional'],
            'peringkat' => ['nullable', 'string', 'max:50'],
            'tanggal_dicapai' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}
