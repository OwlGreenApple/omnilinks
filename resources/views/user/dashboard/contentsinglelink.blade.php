
@if(!$links->count())
<tr align="center">
		<td colspan="4">No Data To show</td>
	</tr>
	@else
@foreach($links as $link)
	<tr align="center">
		<td>{{$link->title}}</td>
		<td>{{$link->judul}}</td>
		<td>{{$link->shorten}}</td>
		<td><button type="button" class="btn btn-sm btn-primary btn-editlink" dataeditid="{{$link->idlink}}" datatitle="{{$link->title}}"
		  datapixelid="{{$link->idpixel}}" datalink="{{$link->datalink}}" textpixel="{{$link->judul}}" style="margin-right:5px; "><i class="fas fa-pencil-alt"></i></button>
		<button type="button" onclick="return confirm('anda yakin ingin menghapus walink ini')" class="btn btn-sm btn-danger btn-deletelink" datadeleteid="{{$link->idlink}}"><i class="fas fa-trash-alt"></i></button></td>
	</tr>
	@endforeach
	@endif