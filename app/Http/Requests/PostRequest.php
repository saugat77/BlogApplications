<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'thumbnail' => 'nullable|string|max:500',
            'category_ids' => 'required|array',
            'tag_ids' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A post title is required.',
            'body.required' => 'The post body cannot be empty.',
            'category_ids.required' => 'Select Categories.',
            'category_ids.exists' => 'Selected category is invalid.',
            'tag_ids.*.exists' => 'One or more tags are invalid.',
        ];
    }
}
