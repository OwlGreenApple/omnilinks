<?php 
use App\User;
?>
@foreach($ads as $data)
  <tr>
    <td data-label="Email">
      <?php 
        $user = User::find($data->user_id);
        if(!is_null($user)){
          echo $user->email;
        }
      ?>
    </td>
    <td data-label="">
      {{$data->headline}}
    </td>
    <td data-label="">
      {{$data->link}}
    </td>
    <td data-label="">
      {{$data->description}}
    </td>
    <td data-label="">
      {{$data->credit}}
    </td>
    <td >
      {{$data->created_at}}
    </td>
  </tr>
@endforeach