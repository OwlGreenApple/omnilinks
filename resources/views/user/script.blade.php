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
      if($user->membership!='free'){
        echo $script;  
      }
    ?>
  </script>
  <script type="text/javascript">
    window.location.href="<?php echo $link; ?>";
    console.log("a");
  </script>
</head>

<body>  

</body>
</html>