<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'url' => 'sometimes|string',
            'thumbnail_url' => 'sometimes|string',
            'tags' => 'sometimes|array',
            'tags.*' => 'string',
        ];
    }
}
