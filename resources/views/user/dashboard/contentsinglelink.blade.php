
@if(!$links->count())
  <tr align="center">
    <td colspan="4">No Data To show</td>
  </tr>
@else
  @foreach($links as $link)
    <tr align="center">
      <td>
        <div class="menu-mobile">
          <div class="view-details" data-id="{{$link->id}}">
            <span class="menu-mobile icon-dropdown">
              <i class="fas fa-sort-down"></i>
            </span>  
            {{$link->title}}
          </div>
        </div>

        <div class="menu-nomobile">
          {{$link->title}}
        </div>
      </td>

      @if((Auth::user()->membership=='basic') OR (Auth::user()->membership=='elite'))
        <td class="menu-nomobile">{{$link->judul}}</td>
      @endif

      <td class="menu-nomobile">
        Omn.lkz/{{$link->shorten}}&nbsp;
        <span class="btn-copy" data-copy="Omn.lkz/{{$link->shorten}}">
          <i class="far fa-copy"></i>  
        </span>
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-primary btn-editlink" dataeditid="{{$link->idlink}}" datatitle="{{$link->title}}"
        datapixelid="{{$link->idpixel}}" datalink="{{$link->datalink}}" textpixel="{{$link->judul}}" style="margin-right:5px; ">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-deletelink" datadeleteid="{{$link->idlink}}">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    </tr>

    <tr class="details-{{$link->id}} d-none">
      <td colspan="2">
        Link : <b>Omn.lkz/{{$link->shorten}}&nbsp;</b><br>
        Pixel : {{$link->judul}} <br>
      </td>
    </tr>
  @endforeach
@endif