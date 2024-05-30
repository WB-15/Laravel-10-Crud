<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric',
            'average_rating' => 'nullable|numeric',
            'ratings_count' => 'nullable|integer',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }
}
