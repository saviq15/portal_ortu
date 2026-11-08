<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,guru,wali_kelas,pihak_yayasan,orang_tua'],
            'siswa_id' => ['nullable', 'exists:siswas,id'],
            'kelas_id' => ['nullable', 'exists:kelas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'role.in' => 'Role pengguna tidak valid.',
        ];
    }
}
