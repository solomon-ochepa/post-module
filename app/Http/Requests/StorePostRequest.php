<?php

namespace Modules\Post\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('posts.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'post.title'    => ['required', 'string', 'min:3', 'max:200'],
            'post.body'     => ['required', 'string', 'min:3', 'max:800'],
            'post.allow_comments'   => ['nullable', 'string', 'in:on,'],
            'post.user_id'  => ['required', 'uuid'],
            'images'        => ['nullable', 'image']
        ];
    }
}
