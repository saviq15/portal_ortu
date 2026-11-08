<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKelasRequest extends FormRequest
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
            'nama_kelas' => ['required', 'string', 'max:50'],
            'tingkat' => ['required', 'string', 'max:10'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
        ];
    }
}
