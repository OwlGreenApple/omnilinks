<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Helpers\Helper;

class TrustedUrlCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $index; 
    public function __construct($index)
    {
        $this->index = (int)$index+=1;
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
        return Helper::CheckTrustedLink($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Link no : <b>'.$this->index.'</b> yang anda masukkan diblacklist oleh kominfo.go.id';
    }
}
