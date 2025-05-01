<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
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
            'user_id' => 'nullable|string|unique:pegawais,user_id',
            'name' => 'required|string|max:255',
            'nip' => 'required|string|min:8|unique:pegawais,nip',
            'gender' => 'required|in:L,P',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'phone_number' => 'required|string|min:8',
            'position' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
        ];
    }
}