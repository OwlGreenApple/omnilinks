@foreach($data['chart'] as $arr)
  <tr> 
    <td>{{date('l, d F Y',$arr['x']/1000)}}</td>
    <td>{{$arr['y']}}</td> 
  </tr>
@endforeach