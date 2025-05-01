<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKunjunganPetugasRequest extends FormRequest
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

        $kunjungan = $this->route('kunjungan');

        return [
            'no_visit' => 'string|unique:kunjungans,no_visit,' . $kunjungan->id,
            'visit_date' => 'required|date',
            'visit_type' => 'required|in:umum,bpjs',
            'complaint' => 'required|string|max:255',
            'doctor_id' => 'required|exists:pegawais,id',
        ];
    }
}
