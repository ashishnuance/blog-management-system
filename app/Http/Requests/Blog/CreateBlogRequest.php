<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|max:250',
            'category'=>'required|array|min:1',
            'tags'=>'required',
            'sechedule_post_on_date'=>'required|date',
            'sechedule_post_on_time'=>'required|date_format:H:i',
            'image_video_file'=>'required',
            'image_video_file.*'=>'mimes:jpg,jpeg,gif,png,webp,svg,mp4,webm'
        ];
    }
}
