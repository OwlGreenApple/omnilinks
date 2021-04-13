<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckFBEvents implements Rule
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

        To validate fb events to prevent user change defalt value of fb event option value
     */
    public function passes($attribute, $value)
    {
        $fb_events = [
          'AddPaymentInfo',
          'AddToCart',
          'AddToWishlist',
          'CompleteRegistration',
          'Contact',
          'CustomizeProduct',
          'Donate',
          'FindLocation',
          'InitiateCheckout',    
          'Lead',
          'Purchase',
          'Schedule',
          'Search',
          'StartTrial',   
          'SubmitApplication',
          'Subscribe',
          'ViewContent',
          'CustomEvent',
        ];

        $search = array_search($value, $fb_events, true);

        if($search == false)
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
        return 'Harap tidak mengganti nilai asal.';
    }
}
