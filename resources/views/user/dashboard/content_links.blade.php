<ul class="col-md-12" id="viewLink" >
  @if($links->count() > 0)
    @foreach($links as $link)
      <li id="link-preview-{{$link->id}}">
          @if($link->options == 1)
            <a href="#" class="btn btn-md btnview title-{{$link->id}}-view-update txthov" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-{{$link->id}}-get" >{{$link->title}}</a>
          @else
            <div class="embed-responsive embed-responsive-16by9">
                <iframe style="padding : 12px" class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $link->youtube_embed }}?rel=0" allowfullscreen></iframe>
            </div>
          @endif
      </li>
    @endforeach
  @endif
</ul>