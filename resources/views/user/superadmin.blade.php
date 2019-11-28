<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | New Activfans</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('/images/celebgramme-favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"></link>
    <link href="{{ asset('datatables/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet"></link>
    


  
    <!-- Jquery Core Js -->
    <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
    <!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('datatables/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>

    <script>
      $(document).ready(function(){
        $("#div-loading").hide();
      });
    </script>
    
  </head>
  <script type="text/javascript">
    var table;
    $(document).ready(function() {
      table = $('#myTable').DataTable({
      });
    });
  </script>
  <body>
    <div class="container">
      <br> <br>
      <table class="table" id="myTable">
        <thead align="center">
          <th>Email</th>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>
                <a href='<?php echo url("check-super")."/".$user->id ?>'>
                  {{$user->email}}
                </a>
              </td>
              <td>
                {{$user->names}}
              </td>
              <td>
                {{$user->premium_names}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
