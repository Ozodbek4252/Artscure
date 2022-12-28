<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
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
        if ($this->_method == null) {
            $image = 'required|mimes:jpeg,png,jpg,gif,svg';
        } else {
            $image = 'nullable|mimes:jpeg,png,jpg,gif,svg';
        }

        return [
            'first_name_uz' => 'required|string',
            'first_name_ru' => 'required|string',
            'first_name_en' => 'nullable|string',
            'last_name_uz' => 'nullable|string',
            'last_name_ru' => 'nullable|string',
            'last_name_en' => 'nullable|string',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',

            'speciality' => 'required|string|max:30',
            'rate' => 'nullable|numeric|between:0,5',
            'category_id' => 'required|integer',
            'image' => $image,
            'muzey_uz' => 'nullable|string',
            'muzey_ru' => 'nullable|string',
            'muzey_en' => 'nullable|string',
            'medal_uz' => 'nullable|string',
            'medal_ru' => 'nullable|string',
            'medal_en' => 'nullable|string',
            'label' => 'nullable|string',
            'tools' => 'required|array',
            'tools.*' => 'required|numeric'
        ];
    }
}
