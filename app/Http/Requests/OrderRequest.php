<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'name' => 'required|string',
            'phone' => 'required',
            'payment_type' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
        ];
    }
}
