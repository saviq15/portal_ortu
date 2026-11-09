<?php

namespace App\Http\Requests;

use App\Models\PrestasiSiswa;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PrestasiSiswaController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function index() {
        return response()->json([
            'data' => PrestasiSiswa::with('siswa')->latest()->paginate(10)
        ]);
    }

    
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
            //
        ];
    }
}
