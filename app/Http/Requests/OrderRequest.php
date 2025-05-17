<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users for now
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'The selected product is invalid.',
            'quantity.required' => 'Please specify a quantity.',
            'quantity.integer' => 'Quantity must be a valid number.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}


