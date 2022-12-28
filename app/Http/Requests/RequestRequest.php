<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRequest extends FormRequest
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
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'portfolio' => 'nullable|max:10000|mimes:doc,docx,pdf',
            'cover_letter' => 'required|min:30',
        ];
    }
}
