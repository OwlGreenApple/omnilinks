<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

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
      $status = null;
      $curl = curl_init();
      $data = array(
          'name'=>$this->filter_url($value)
      );

      $url = "https://trustpositif.kominfo.go.id/Rest_server/getrecordsname_home";
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST=>0,
        CURLOPT_SSL_VERIFYPEER=>0,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTREDIR => 3,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      if ($err) {
        return false;
        // echo "cURL Error #:" . $err;
      } 
      else
      {
        $status = json_decode($response,true)['values'][0]['Status'];
      }

      if($status == 'Ada')
      {
        return false;
      }
      else
      {
        return true;
      }      
    }

    // remove http and another parameter
    private function filter_url($url)
    {
      $filter = explode('/',$url);
      return $filter[2];
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
