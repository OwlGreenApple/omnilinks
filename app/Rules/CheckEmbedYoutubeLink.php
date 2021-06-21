<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckEmbedYoutubeLink implements Rule
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
        /*$match = preg_match("/^https\:\/\/(www)\.(youtube)\.(com)\/watch\?v\=.+|^https\:\/\/(youtu)\.be\/.+/i", $value);*/
        $val = "https://www.youtube.com/watch?v=".$value;
        $match = @file_get_contents("https://www.youtube.com/oembed?url=".$val."&format=json");

        if($match == false)
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
        return 'Youtube link pada urutan : '.$this->index.' tidak valid.';
    }
}
