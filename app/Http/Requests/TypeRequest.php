<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
        if($this->_method == null) {
            $image = 'required|image|mimes:jpeg,png,jpg,gif,svg';
        }else{
            $image = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
        }

        return [
            'name_uz' => 'required|string',
            'name_ru' => 'required|string',
            'name_en' => 'required|string',
            'category_id' => 'required|integer',
            'image' => $image
        ];
    }
}
