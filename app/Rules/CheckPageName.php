<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Page;
use Auth;

class CheckPageName implements Rule
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
        $page_name = Page::where([['user_id',Auth::id()],['names',$value]])->orWhere('premium_names',$value)->first();

        if(is_null($page_name))
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
        return 'Nama page tidak tersedia.';
    }
}
