<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKunjunganPetugasRequest extends FormRequest
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
        return [
            'no_visit' => 'string|unique:kunjungans,no_visit',
            'visit_date' => 'required|date',
            'pasien_id' => 'required|exists:pasiens,id',
            'visit_type' => 'required|in:umum,bpjs',
            'complaint' => 'required|string|max:255',
            'status' => 'in:pendaftaran,pemeriksaan,selesai',
            'pegawai_id' => 'exists:pegawais,id',
            'doctor_id' => 'required|exists:pegawais,id'
        ];
    }
}