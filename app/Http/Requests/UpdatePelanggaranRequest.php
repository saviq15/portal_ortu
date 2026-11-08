<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePelanggaranRequest extends FormRequest
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
            'jenis_pelanggaran' => ['required', 'string', 'max:255'],
            'poin' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}
