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
            return [
                'name_uz' => 'required|string|max:30',
                'name_ru' => 'required|string|max:30',
                'name_en' => 'required|string|max:30',
                'category_id' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ];
        }else{
            return [
                'name_uz' => 'required|string|max:30',
                'name_ru' => 'required|string|max:30',
                'name_en' => 'required|string|max:30',
                'category_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ];
        }
    }
}
