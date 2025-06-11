<?php

namespace App\Http\Requests\v1\PizzaType;

use Illuminate\Foundation\Http\FormRequest;

class PizzaTypeRequest extends FormRequest
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
            'name' => 'required|string',
            'category' => 'required|string',
            'slug' => 'required|unique:pizza_types,slug',
            'ingredients' => 'required|string'
        ];
    }
}
