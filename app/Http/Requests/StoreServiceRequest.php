<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'materials' => json_decode($this->materials, true),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:255|exists:units,code',
            'labor_cost' => 'required|numeric|min:0',
            'pricing_mode' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'active' => 'nullable|boolean',
            'materials' => 'required_unless:pricing_mode,FIXED|array',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.material_id' => 'required|numeric|exists:materials,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'materials.required_unless' => 'Bahan layanan harus diisi jika metode harga adalah markup',
        ];
    }
}
