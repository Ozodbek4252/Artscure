<?php

namespace App\Http\Requests;

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
        return [
            'name_uz' => 'required|string',
            'name_ru' => 'required|string',
            'name_en' => 'required|string',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description_en' => 'nullable|string',
            'certificate' => 'boolean',
            'artist_id' => 'required|integer',
            'type_id' => 'required|integer',
            'frame' => 'boolean',
            'size' => 'nullable|string',
            'year' => 'nullable|string',
            'unique' => 'boolean',
            'city' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'nullable',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'tools' => 'required',
            'tools.*' => 'required|integer'
        ];
    }
}
