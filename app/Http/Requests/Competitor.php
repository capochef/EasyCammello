<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Competitor extends FormRequest
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
            'name' => 'required|unique:competitors|max:255',
            'category' => 'sometimes|max:255',
            'client' => 'exists:clients',
        ];
    }
}
