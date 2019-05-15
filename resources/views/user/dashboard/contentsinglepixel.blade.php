@if(!$pixels->count())
  <tr align="center">
    <td colspan="3">No Data To show</td>
  </tr>
@else
  @foreach($pixels as $pixel)
    <tr align="center">
      <td>
        <div class="menu-mobile">
          <div class="view-details-pixel" data-id="{{$pixel->id}}">
            <span class="menu-mobile icon-dropdown">
              <i class="fas fa-sort-down"></i>
            </span>  
            {{$pixel->title}}
          </div>
        </div>

        <div class="menu-nomobile">
          {{$pixel->title}}
        </div>
      </td>	
      <td class="menu-nomobile">
        {{date("d F Y", strtotime($pixel->created_at))}}
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-primary btn-editpixel " dataeditid="{{$pixel->id}}" datatitle="{{$pixel->title}}" datascript="{{$pixel->script}}" datajenis="{{$pixel->jenis_pixel}}" style="margin-right:5px; ">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-deletepixelsingle" dataid="{{$pixel->id}}">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>

    <tr class="details-pixel-{{$pixel->id}} d-none">
      <td colspan="2">
        Last Modified : <b>{{date("d F Y", strtotime($pixel->created_at))}}</b>
        <br>
      </td>
    </tr>
  @endforeach
@endif