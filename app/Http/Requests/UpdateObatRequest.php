<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObatRequest extends FormRequest
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

        $obat = $this->route('obat');

        return [
            'code' => 'required|string|unique:obats,code,' . $obat->id,
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'unit' => 'required|in:tablet,botol,ampul',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }
}
