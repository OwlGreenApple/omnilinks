<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Page;
use Auth;

class CheckValidPageID implements Rule
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
        $page = Page::where([['id',$value],['user_id',Auth::id()]]);
        if(is_null($page))
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
        return 'Invalid id';
    }
}
