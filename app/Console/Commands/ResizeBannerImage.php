<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Banner;

class ResizeBannerImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resize:banner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To backup original banner image and resize it on biolinks page';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $banners = Banner::where('images_banner','<>','0')->select('images_banner')->get();

        if($banners->count() > 0)
        {
            foreach($banners as $banner)
            {
                $banner_image = Storage::disk('s3')->url($banner->images_banner);
                $files = explode("/",$banner_image);

                $folder_name = $files[4];
                $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $files[5]); #remove extesnion
                $edited_filename = $filename.'-originbanner.jpg';

                $get_image_file = Storage::disk('s3')->get($banner->images_banner);

                 #BACKUP ORIGINAL IMAGE
                Storage::disk('s3')->put('banner/'.$folder_name."/".$edited_filename,$get_image_file);

                #SAVE FILE ON LOCAL STORAGE TEMPORARY
                Storage::disk('local')->put('test/'.$folder_name."/".$files[5],$get_image_file);
                $image_file_local = storage_path('app/test/'.$folder_name."/".$files[5]);

                #CHANGE AND RESIZE THE ORIGINAL IMAGE
                $this->runresize($image_file_local,$folder_name,$files[5]);
            }
        }#end if
        else
        {
            echo 'Nothing banner image to resize';
        }
    }

    public function runresize($filepath,$folder_name,$file_name)
    {
        $this->resize_image($filepath, 434, 200,false,$folder_name,$file_name);
    }

    public function resize_image($file, $w, $h, $crop=false,$folder_name,$file_name) {
      list($width, $height) = getimagesize($file);
      $r = $width / $height;

      if ($crop) {
          if ($width > $height) {
              $width = ceil($width-($width*abs($r-$w/$h)));
          } else {
              $height = ceil($height-($height*abs($r-$w/$h)));
          }
          $newwidth = $w;
          $newheight = $h;
      } else {
          if ($w/$h > $r) {
              $newwidth = $h*$r;
              $newheight = $h;
          } else {
              $newheight = $w/$r;
              $newwidth = $w;
          }
      }

      #Check whether the file is valid jpg or not
      switch(exif_imagetype($file)){
        case IMAGETYPE_PNG:
            $newfile = str_replace(".jpg",".png",$file);
            rename($file,$newfile);
            //return $this->convertToJPGImage($newfile,$newwidth, $newheight,$width, $height);
        break;
        case IMAGETYPE_GIF:
            $newfile = str_replace(".jpg",".gif",$file);
            rename($file,$newfile);
            //return $this->convertGIFtoJPGImage($newfile,$newwidth, $newheight,$width, $height);
        break;
        case IMAGETYPE_JPEG:
            $newfile = $file;
        break;
      }

      //Get file extension
      $exploding = explode(".",$newfile);
      $ext = end($exploding);
      
      switch($ext){
          case "png":
              $src = imagecreatefrompng($newfile);
          break;
          case "jpeg":
          case "jpg":
              $src = imagecreatefromjpeg($newfile);
          break;
          case "gif":
              $src = imagecreatefromgif($newfile);
          break;
          default:
              $src = imagecreatefromjpeg($newfile);
          break;
      }
      
      $path = "banner/".$folder_name."/".$file_name;

      if($ext == "png")
      {
         $dst = imagecreate($newwidth, $newheight);
         imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

         $temp_name = str_replace(".jpg", ".png", $file_name);
         ob_start();
         imagepng($dst,null,5);
         $image_contents = ob_get_clean();

         Storage::disk('s3')->put($path,$image_contents,'public');
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$temp_name);
      }
      else if($ext == "gif")
      {
         $dst = imagecreatetruecolor($newwidth, $newheight);
         imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
         $temp_name = str_replace(".jpg", ".gif", $file_name);
         ob_start();
         imagegif($dst);
         $image_contents = ob_get_clean();

         Storage::disk('s3')->put($path,$image_contents,'public');         
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$temp_name);
      }
      else
      {
         $dst = imagecreatetruecolor($newwidth, $newheight);
         imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
         ob_start();
         imagejpeg($dst);
         $image_contents = ob_get_clean();

         Storage::disk('s3')->put($path,$image_contents,'public');
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$file_name);
      }
      
   }

/* end class file */    
}
