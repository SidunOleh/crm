<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class Permission implements Rule, DataAwareRule
{
    protected $operation;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->operation == 'create') {
            return $value == 0 or $value == 1 ?: false;   
        } else {           
            return $value >= 0 and $value <= 2 ?: false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid permission value.';
    }

    public function setData($inputs)
    {
        $this->operation = $inputs['operation'];

        return $this;
    }
}
