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
    <td data-label="Headline">
      {{$data->headline}}
    </td>
    <td data-label="Link">
      {{$data->link}}
    </td>
    <td data-label="Description">
      {{$data->description}}
    </td>
    <td data-label="Credit">
      {{$data->credit}}
    </td>
    <td data-label="Created">
      {{$data->created_at}}
    </td>
  </tr>
@endforeach