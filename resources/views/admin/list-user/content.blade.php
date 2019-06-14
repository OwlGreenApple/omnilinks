@foreach($users as $user)
  <tr>
    <td data-label="Name">
      {{$user->name}}
    </td>
    <td data-label="Email">
      {{$user->email}}
    </td>
    <td data-label="Username">
      {{$user->username}}
    </td>
    <td data-label="Status">
      @if($user->is_admin==1)
        Admin
      @else 
        User
      @endif
    </td> 
    <td data-label="Membership">
      {{$user->membership}}
    </td>
    <td data-label="Valid_until">
      @if($user->valid_until==null)
        Unlimited
      @else 
        {{$user->valid_until}}
      @endif
    </td>
    <td data-label="Action">
      <button type="button" class="btn btn-primary btn-edit" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-username="{{$user->username}}" data-is_admin="{{$user->is_admin}}" data-membership="{{$user->membership}}" data-valid_until="{{$user->valid_until}}">
        Edit User
      </button>
      <button type="button" class="btn btn-primary btn-log" data-toggle="modal" data-target="#view-log" data-id="{{$user->id}}">
        Log
      </button>
    </td>
  </tr>
@endforeach