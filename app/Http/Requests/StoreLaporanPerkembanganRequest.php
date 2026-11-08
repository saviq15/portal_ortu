<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanPerkembanganRequest extends FormRequest
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
            'semester' => ['required', 'in:1,2'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
            'catatan_akademik' => ['nullable', 'string'],
            'catatan_karakter' => ['nullable', 'string'],
            'rekomendasi_perbaikan' => ['nullable', 'string'],
        ];
    }
}
