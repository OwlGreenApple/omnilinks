<!DOCTYPE html>

<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta property="og:type" content="article">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>

  <title>Script</title>
  <script type="text/javascript">
    <?php 
      $dt1 = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
      $dt2 = Carbon::now();
      if ( ($user->membership=='free') && ($dt2->gt($dt1)) ) {
        //tidak menjalankan script apa2
      } 
      else {
        echo $script;  
      }
    ?>
  </script>
  <script type="text/javascript">
    window.location.href="<?php echo $link; ?>";
  </script>
</head>

<body>  

</body>
</html>