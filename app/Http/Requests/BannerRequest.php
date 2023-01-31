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
        if($this->_method == 'PUT') {
            $image = 'nullable|mimes:jpeg,png,jpg,gif,svg';
        } else {
            $image = 'required|mimes:jpeg,png,jpg,gif,svg';
        };
        return [
            'type' => 'required|in:top,bottom,other',
            'title_uz' => 'required|max:100',
            'title_ru' => 'required|max:100',
            'title_en' => 'required|max:100',
            'body_uz' => 'nullable',
            'body_ru' => 'nullable',
            'body_en' => 'nullable',
            'image' => $image,
        ];
    }
}
