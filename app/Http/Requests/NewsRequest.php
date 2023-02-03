<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title_uz' => 'required',
            'title_ru' => 'required',
            'title_en' => 'required',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
            'image' => $image,
            'category_id' => 'required|exists:news_categories,id',
        ];
    }
}
