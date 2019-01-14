<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TagMinRule implements Rule
{

    protected $number;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($number = 3)
    {
        //
        $this->number = $number;
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
        $a = explode(',', $value);
        if (count($a) >= $this->number) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.custom.tag.min', ['num' => $this->number]);
    }
}
