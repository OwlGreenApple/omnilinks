@if($users->count() > 0)
  @php $no = 1; @endphp
  @foreach($users as $user)
    <tr>
      <td>{{$no}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>---</td>
      <td><a class="open_detail" id="{{$user->id}}">View Detail</a></td>
    </tr>
    @php $no++; @endphp
  @endforeach
@endif
