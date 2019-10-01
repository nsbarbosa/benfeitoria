<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'author' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000',
            'title' => 'required',
            'content' => 'required'
        ];

        return $rules;
    }

    /**
     * Translate fields with user friendly name.
     *
     * @return array
     */
    public function attributes(){
        $attributes = [
            'author' => trans('post.author'),
            'image' => trans('post.image'),
            'title' => trans('post.title'),
            'content' => trans('post.content')
        ];

        return $attributes;
    }
}
