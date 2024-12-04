<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'parent_id' => ['nullable', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
    'name.required' => __('common.name_required'),
    'name.string' => __('common.name_string'),
    'name.max' => __('common.name_max'),
    'description.string' => __('common.description_string'),
    'image_path.image' => __('common.image_path_image'),
    'image_path.mimes' => __('common.image_path_mimes'),
    'image_path.max' => __('common.image_path_max'),
    'parent_id.integer' => __('common.parent_id_integer'),
];
    }
}
