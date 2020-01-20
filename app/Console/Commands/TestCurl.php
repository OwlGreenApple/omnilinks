<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCurl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:curl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      //echo "ww";
        $curl = curl_init();
        $data = array(
            'token'=> '0698a365aec87be50795ab07230d7df55df6eda532b81',
            'username'=>"activtelsby",
            'message'=>"qweasdzxc",
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://172.98.193.36/phptdlib/php_examples/sendMessage.php",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          // echo $response."\n";
          print_r($response);
          // return json_decode($response, true);
        }

    }
}
