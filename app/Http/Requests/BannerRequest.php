<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        // type: 0 - top, 1 - bottom
        return [
            'type' => 'required',
            'title_uz' => 'required|min:5|max:100',
            'title_ru' => 'required|min:5|max:100',
            'title_en' => 'required|min:5|max:100',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}