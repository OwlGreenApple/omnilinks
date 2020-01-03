@foreach($data as $row)
  <tr>
    <td>{{$row->label}}</td>
    <td>{{$row->type}}</td>
    <td><img class="catalog-image" src="{!! Storage::disk('s3')->url($row->path) !!}" /></td>
    <td>{{$row->desc}}</td>
    <td data-label="Action">
      <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="{{$row->id}}" data-toggle="modal" data-target="#add-catalog" data-label="{{$row->label}}" data-coupon-id="{{$row->coupon_id}}" data-type="{{$row->type}}" data-image ="{{$row->path}}" data-desc="{{$row->desc}}" data-link="{{$row->coupon_url}}" data-coupon="{{$row->kodekupon}}" data-exp="{{$row->valid_until}}">
        <i class="fas fa-pen"></i>
      </button>  
      <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{$row->id}}" data-toggle="modal" data-target="#confirm-delete">
        <i class="far fa-trash-alt"></i>
      </button>  
    </td>
  </tr>
@endforeach