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
        return [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('messages.post.validate.title_required'),
            'category_id.required' => trans('messages.post.validate.category_required'),
            'thumbnail_url.required' => trans('messages.post.validate.thumbnail_required'),
            'thumbnail_url.image' => trans('messages.post.validate.thumbnail_image'),
            'content.required' => trans('messages.post.validate.content_required'),
        ];
    }
}
