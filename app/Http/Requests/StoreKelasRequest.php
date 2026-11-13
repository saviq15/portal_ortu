<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKelasRequest extends FormRequest
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
            'unit' => ['required', Rule::in(['mi', 'smk'])],
            'nama_kelas' => ['required', 'string', 'max:50', 'unique:kelas,nama_kelas'],
            'wali_kelas_id' => [
                'required',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', 'wali_kelas')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'unit.required' => 'Unit pendidikan wajib dipilih.',
            'unit.in' => 'Unit pendidikan yang dipilih tidak valid.',
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
            'wali_kelas_id.required' => 'Wali kelas wajib dipilih.',
            'wali_kelas_id.exists' => 'Wali kelas harus berasal dari akun dengan peran Wali Kelas.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_kelas' => trim((string) $this->input('nama_kelas', '')),
        ]);
    }
}
