<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
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
        $siswaId = $this->route('siswa');
        
        return [
            'nis' => ['required', 'string', 'max:20', Rule::unique('siswas', 'nis')->ignore($siswaId)],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'kelas' => ['required', 'string', 'max:50'],
            'alamat' => ['nullable', 'string'],
            'nama_wali' => ['nullable', 'string', 'max:255'],
            'no_hp_wali' => ['nullable', 'string', 'max:15'],
        ];
    }
}
