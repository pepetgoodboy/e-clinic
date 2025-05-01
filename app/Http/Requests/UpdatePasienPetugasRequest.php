<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasienPetugasRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $pasien = $this->route('pasien');

        return [
            'no_rekam_medis' => 'string|unique:pasiens,no_rekam_medis,' . $pasien->id,
            'nik' => 'string|unique:pasiens,nik,' . $pasien->id,
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string|max:255',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'phone_number' => 'required|string|min:8',
        ];
    }
}