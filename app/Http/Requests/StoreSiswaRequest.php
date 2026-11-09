<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
            'nis' => ['required', 'string', 'max:20', 'unique:siswas,nis'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'kelas' => ['required', 'string', 'max:50'],
            'alamat' => ['nullable', 'string'],
            'nama_wali' => ['nullable', 'string', 'max:255'],
            'no_hp_wali' => ['nullable', 'string', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => 'Nomor Induk Siswa (NIS) wajib diisi.',
            'nis.unique' => 'NIS tersebut sudah terdaftar di sistem.',
            'nama_lengkap.required' => 'Nama lengkap siswa wajib diisi.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin siswa.',
        ];
    }
}
