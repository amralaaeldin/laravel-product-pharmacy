<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'string|unique:products,title,' . $this->product,
            'description' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pharmacies' => 'nullable|array',
            'pharmacies.*.id' => 'required_if:pharmacies,!=null|exists:pharmacies',
            'pharmacies.*.price' => 'required_if:pharmacies,!=null|numeric|min:0',
            'pharmacies.*.quantity' => 'required_if:pharmacies,!=null|integer|min:0',
        ];
    }
}
