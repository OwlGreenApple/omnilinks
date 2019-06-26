<?php
if (env('APP_ENV')=='local') {
  $binary = base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf');
} else {
  $binary = base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
  // $binary = '/usr/local/bin/wkhtmltopdf';
  //$binary = base_path('vendor\rvanlaak\wkhtmltopdf-amd64-centos7\bin\wkhtmltopdf-amd64');
}

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => $binary,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        // 'binary'  => base_path('vendor\wemersonjanuario\wkhtmltoimage-windows\bin\64bit\wkhtmltoimage'),
        'binary'  => '/usr/local/bin/wkhtmltoimage-amd64',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
