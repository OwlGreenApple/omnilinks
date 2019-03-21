<div class="c">
<input type="text" name="judulBanner[]" value="" class="form-control" placeholder="Judul banner">
   <input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link">
    <select name="bannerpixel[]" class="form-control">
        <option value="">--Pilih Pixel Yang telah dibuat--</option>
        @foreach($pixels as $pixel)
        <option value="{{$pixel->id}}">{{$pixel->title}}</option>
        @endforeach
    </select>
    <input type="file" name="bannerImage[]" value="Upload">
    <button class="btn btn-primary btn-deleteBanner"><i class="fa fa-trash-alt"></i></button>
    </div>