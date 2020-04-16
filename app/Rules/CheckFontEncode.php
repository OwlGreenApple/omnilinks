<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckFontEncode implements Rule
{
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
        $check = mb_detect_encoding($value);

        if($check == false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mohon untuk tidak menggunakkan styling font seperti : cetak tebal (bold), cetak miring (italic) dsb.';
    }
}
