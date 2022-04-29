<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Permission;

class PermissionChangeRequest extends FormRequest
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
            'resource'   => ['required', Rule::in(
                ['projects', 'contacts', 'tasks',]
            ),],
            'operation'  => ['required', Rule::in(
                ['create', 'read', 'update', 'delete',]
            ),],
            'permission' => ['required', 'integer', new Permission(),],
        ];
    }
}
