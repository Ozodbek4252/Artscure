<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            $main_image = 'required|mimes:jpeg,png,jpg,gif,svg';
        } else {
            $main_image = 'nullable|mimes:jpeg,png,jpg,gif,svg';
        }

        $current_year = Carbon::now()->format('Y');
        $year = 'nullable|numeric|between:0,'.$current_year;

        return [
            'name_uz' => 'required|string',
            'name_ru' => 'required|string',
            'name_en' => 'required|string',
            'description_uz' => 'required|string',
            'description_ru' => 'required|string',
            'description_en' => 'nullable|string',

            'artist_id' => 'required|integer',
            'type_id' => 'required|integer',
            'tools' => 'required',
            'tools.*' => 'required|integer',

            'main_image' => $main_image,
            'images' => 'nullable',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg',

            'price' => 'nullable|numeric',
            'city' => 'nullable|string',
            'size' => 'nullable|string',
            'year' => $year,
            'status' => 'nullable|string',

            'unique' => 'nullable',
            'certificate' => 'nullable',
            'signiture' => 'nullable',
            'frame' => 'nullable',
        ];
    }
}
