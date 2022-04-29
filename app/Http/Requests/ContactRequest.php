<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'email'   => 'required|email',
            'name'    => 'required|string|min:3|max:30',
            'surname' => 'required|string|min:3|max:30',
            'phone'   => 'nullable|string|min:3|max:30',
            'type'    => ['required', Rule::in([
                'partner', 'agent', 'client',
            ]),],
        ];
    }
}
