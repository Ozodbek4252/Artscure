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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name_uz' => 'required|string|max:30',
            'first_name_ru' => 'required|string|max:30',
            'first_name_en' => 'required|string|max:30',
            'last_name_uz' => 'required|string|max:30',
            'last_name_ru' => 'required|string|max:30',
            'last_name_en' => 'required|string|max:30',
            'description_uz' => 'required|string|max:30',
            'description_ru' => 'required|string|max:30',
            'description_en' => 'required|string|max:30',
            'category_id' => 'required|integer',
            'speciality' => 'required|string|max:30',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
