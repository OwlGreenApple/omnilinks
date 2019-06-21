<?php
if (env('APP_ENV')=='local') {
  $binary = base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf');
} else {
  $binary = '/usr/local/bin/wkhtmltopdf';
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
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
