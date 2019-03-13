	@foreach($links as $link)
	<tr align="center">
		<td>{{$link->title}}</td>
		<td>{{$link->judul}}</td>
		<td>{{$link->shorten}}</td>
	</tr>
	@endforeach