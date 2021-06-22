<?php

namespace App\Http\Requests\Album;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'archive_id' => '',
            'title' => 'string',
            'description' => 'string',
            'image_file' => 'image|max:4096',
            'slug' => 'string',
            'fileMulti.*' => 'mimes:jpeg,jpg,png,gif,webp,svg|max:4096'
        ];
    }
}
