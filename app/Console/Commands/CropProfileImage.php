<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Page;

class CropProfileImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crop:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup original biolinks image profile on folder : storage/backupimageprofile and then resize profile image on biolinks, ';

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

        $pages = Page::where('image_pages','<>',null)->select('image_pages')->get();
        foreach($pages as $page)
        {
            #GET IMAGE LINK / URL
            $image_file = Storage::disk('s3')->url($page->image_pages);
            $files = explode("/",$image_file);

            $folder_name = $files[4];
            $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $files[5]); #remove extesnion
            $edited_filename = $filename.'-origin.jpg';

            $get_image_file = Storage::disk('s3')->get($page->image_pages);
            #BACKUP ORIGINAL IMAGE
            //Storage::disk('s3')->put('photo_page/'.$folder_name."/".$edited_filename,$get_image_file);

            #SAVE FILE ON LOCAL STORAGE TEMPORARY
            Storage::disk('local')->put('test/'.$folder_name."/".$files[5],$get_image_file);
            $image_file_local = storage_path('app/test/'.$folder_name."/".$files[5]);
            $s3path = $page->image_pages;

            #CHANGE AND RESIZE THE ORIGINAL IMAGE
            $this->runresize($image_file_local,$s3path,$folder_name,$files[5]);
        }
    }

    public function runresize($filepath,$s3path,$folder_name,$file_name)
    {
      //$filename = storage_path('img').'/teknobie.jpg';
      //$resizedFilename = storage_path('img').'/resize/test.jpg';

      // resize the image with 100x100
      $imgData = $this->resize_image($filepath, 100, 100,false,$folder_name,$file_name,$s3path);
      //Storage::disk('local')->put('test'."/".$filename,$filepath);

      // save the image on the given filename
      //imagejpeg($imgData, $resizedFilename);
      // or according to the original format, use another method
      // imagejpeg($imgData, $resizedFilename);
      // imagegif($imgData, $resizedFilename);
    }

    public function resize_image($file, $w, $h, $crop=false,$folder_name,$file_name,$s3path) {
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
      
      $dst = imagecreatetruecolor($newwidth, $newheight);
      imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

      if($ext == "png")
      {
         $temp_name = str_replace(".jpg", ".png", $file_name);
         ob_start();
         imagepng($dst);
         $image_contents = ob_get_clean();

        //$path = 'photo_page/'.$folder_name."/".$file_name;
         $path = 'photo_page/'.$file_name;
         Storage::disk('local')->put($path,$image_contents);
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$temp_name);
         //Storage::disk('s3')->put($path,$image_contents,'public');
      }
      else if($ext == "gif")
      {
         $temp_name = str_replace(".jpg", ".gif", $file_name);
         ob_start();
         imagegif($dst);
         $image_contents = ob_get_clean();

         //$path = 'photo_page/'.$folder_name."/".$file_name;
         $path = 'photo_page/'.$file_name;
         Storage::disk('s3')->put($path,$image_contents,'public');
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$temp_name);
      }
      else
      {
         ob_start();
         imagejpeg($dst);
         $image_contents = ob_get_clean();

        //$path = 'photo_page/'.$folder_name."/".$file_name;
         $path = 'photo_page/'.$file_name;
         Storage::disk('local')->put($path,$image_contents);
         Storage::disk('local')->delete('test/'.$folder_name.'/'.$file_name);
         //Storage::disk('s3')->put($path,$image_contents,'public');
      }
      
   }

   #TO CONVERT PNG TO JPG
    public function convertToJPGImage($filePath,$newwidth, $newheight, $width, $height)
    {
        $image = imagecreatefrompng($filePath);
        $bg = imagecreatetruecolor($newwidth, $newheight);
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopyresampled($bg, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagedestroy($image);
        $quality = 80; // 0 = worst / smaller file, 100 = better / bigger file 

        $newPath = str_replace(".png", ".jpg", $filePath);

        ob_start();
        imagejpeg($bg);
        $image_contents = ob_get_clean();
        $path = 'photo_page/'.$folder_name."/".$file_name;
        Storage::disk('s3')->put($path,$image_contents,'public');

        //imagejpeg($bg, $newPath, $quality);
        imagedestroy($bg);
    }

    public function convertGIFtoJPGImage($filePath,$newwidth, $newheight, $width, $height)
    {
        $image = imagecreatefromgif($filePath);
        $bg = imagecreatetruecolor($newwidth, $newheight);
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopyresampled($bg, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagedestroy($image);
        $quality = 80; // 0 = worst / smaller file, 100 = better / bigger file 

        $newPath = str_replace(".gif", ".jpg", $filePath);
        imagejpeg($bg, $newPath, $quality);
        imagedestroy($bg);
    }

/* end class cropfile images */    
}
