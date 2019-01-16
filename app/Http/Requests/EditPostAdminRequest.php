<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TagMinRule;

class EditPostAdminRequest extends FormRequest
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
        $tagMinRule = new TagMinRule(config('constants.MIN_TAG'));
        // dd($this->all());
        return [
            'title' => 'required|min:6|max:150|unique:posts,title,' . $this->id,
            'content' => 'required|max:5000',
            'tags' => [
                'required' => 'required',
                'min' => $tagMinRule,
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('validation.required', ['attribute' => __('page.post.title')]),
            'title.min' => __('validation.min.numeric', ['attribute' => __('page.post.title'), 'min' => 6]),
            'title.max' => __('validation.max.numeric', ['attribute' => __('page.post.title'), 'max' => 150]),
            'title.unique' => __('validation.unique', ['attribute' => __('page.post.title')]),
            'content.required' => __('validation.required', ['attribute' => __('page.post.content')]),
            'title.max' => __('validation.max.numeric', ['attribute' => __('page.post.title'), 'max' => 5000]),
            'tags.required' => __('validation.required', ['attribute' => __('page.post.tags')]),
            'tags.min' => __('validation.custom.tag.min', ['num' => config('constants.MIN_TAG')]),
        ];
    }
}
