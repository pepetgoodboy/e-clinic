<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
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
            'no_invoice' => 'string',
            'kunjungan_id' => 'exists:kunjungans,id',
            'total_tindakan' => 'required|numeric',
            'total_obat' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'status' => 'required|in:belum lunas,lunas',
        ];
    }
}
