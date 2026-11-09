<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWawancaraYayasanRequest extends FormRequest
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
            'tanggal_wawancara' => ['required', 'date'],
            'pewawancara' => ['required', 'string', 'max:255'],
            'hasil_catatan' => ['required', 'string'],
            'rekomendasi' => ['nullable', 'string'],
        ];
    }
}
