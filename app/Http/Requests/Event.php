<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Event extends FormRequest
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
            'description' => 'required|max:255',
            'software' => 'sometimes|max:255',
            'competitor' => 'required|exists:competitors,id',
            'points' => 'numeric'
        ];
    }
}
