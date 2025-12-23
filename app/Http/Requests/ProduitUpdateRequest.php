<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitUpdateRequest extends FormRequest
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
            'name'        => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'ref'         => 'sometimes|string|max:255',
            'price'       => 'sometimes|numeric|min:0',
            'marque_id'   => 'sometimes|integer|exists:marque,id',

            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',

            'categories'   => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',


        ];
    }
}
