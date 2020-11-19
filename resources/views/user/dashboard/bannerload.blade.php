@if($banner->count() > 0)
  @php $uc=0; @endphp
    @foreach($banner as $ban)
    @php $uc+=1; @endphp
    <div class="div-table list-banner mb-4" picture-id="picture-id-{{ $uc }}">
      <div class="div-cell">
        <input type="text" name="judulBanner[]" value="{{$ban->title}}" class="form-control" placeholder="Judul banner">
        <input type="hidden" name="idBanner[]" value="{{$ban->id}}">
        <input type="hidden" name="statusBanner[]" class="statusBanner" value="">
        <input type="text" name="linkBanner[]" value="{{$ban->link}}" class="form-control" placeholder="masukkan link">

        <select name="bannerpixel[]" class="form-control bannerpixel bannerpixel-{{$ban->id}}">
        </select>
        <div class="custom-file">
          <input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-<?=$uc?>" aria-describedby="inputGroupFileAddon01" accept="image/*">

          <label class="custom-file-label" for="inputGroupFile01">
            <?php 
              if ($ban->images_banner=="0"){
                echo asset('/image/434x200.jpg');
              }
              else {
                echo basename($ban->images_banner);
              }
            ?>
          </label>
        </div>
      </div>
    @if(Auth::user()->membership!='free')
      <div class="div-cell cell-btn btn-deleteBannerUpdate">
        <span>
          <i class="far fa-trash-alt"></i>
        </span>
      </div>
    @endif  
    <span style="position: absolute;top: 148px;left: 10px;font-size:10px;font-style: italic;">Ukuran Gambar 434x200 Skala 2.2:1 (width:height), Max 500KB, JPG,PNG.</span>
    </div>
    @endforeach
@endif