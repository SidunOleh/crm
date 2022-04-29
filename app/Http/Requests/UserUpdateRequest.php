<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'    => 'nullable|min:3|max:30',
            'surname' => 'nullable|min:3|max:30',
            'phone'   => 'nullable|string|min:3|max:30',
            'avatar'  => 'nullable|image|max:5000',
        ];
    }
}
