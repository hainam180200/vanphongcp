<?php

namespace App\Library;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Img;

class MediaHelpers
{

	static function media($path){

	    if($path==""){
	        return "";
        }
	    //nếu là link http://
		if (strpos($path, '//') > -1) {
			return $path;
		}else{
		    //nếu cấu hình url ftp
            if (!empty(config('filesystems.disks.ftp.url'))){
                return config('filesystems.disks.ftp.url').$path;
            }
            else{
                return config('filesystems.disks.public.folder').$path;
            }



		}
	}

	static function getName($username){
		try{
			$userTransaction = User::where('username',$username)->lockForUpdate()->firstOrFail();
			if(strlen($userTransaction->fullname) > 0)
			{
				return $userTransaction->fullname;
			}
            return str_replace(\Request::gethost().'_','',$username);

		}
		catch (\Exception $e) {
            return str_replace(\Request::gethost().'_','',$username);
        }

	}

    private  static function upload($file = false, $dir, $filename, $width = false, $height = false,$keepOrginExtention = false){
        $result = "";

        try {
            if($keepOrginExtention==true){
                $extension = $file->getClientOriginalExtension();
            }
            else{
                $extension = 'jpg';
            }


            $filename .= ".{$extension}";
            $path = "{$dir}/{$filename}";

            //tạo temp mẫu hình ảnh
            if (!is_dir('temp')) {
                mkdir('temp', 0777);
            }
            $temp = "temp/{$filename}";
            $file->move('temp', $filename);
            //end tạo temp mẫu hình ảnh


            if ($width || $height) {
                $w = $width? $width: null;
                $h = $height? $height: null;
                $img = Img::make($temp);
                if ($img->width() > $w) {
                    $img->resize($w, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    })->brightness(6)->save($temp,80);
                }
            }
            else{
                $img = Img::make($temp)->brightness(6)->save($temp,80);
            }


            //upload vào media
            if (!empty(config('filesystems.disks.ftp.url'))) {

                $storage = Storage::disk('ftp');
                if (strlen(config('filesystems.disks.ftp.folder'))) {
                    $dir = config('filesystems.disks.ftp.folder')."/{$dir}";
                }
                if ($storage->putFileAs($dir, new File($temp), $filename)) {
                    $result = "/{$path}";
                }
            }

            //upload vào local
            else{
                $storage = Storage::disk('public');
                if (strlen(config('filesystems.disks.public.folder'))) {
                    $dir = config('filesystems.disks.public.folder')."/{$dir}";
                }

                if ($storage->putFileAs($dir, new File($temp), $filename)) {
                    $result = "/{$path}";
                }
            }
            if (file_exists($temp)) {
                unlink($temp);
            }



        } catch (\Exception $e) {

            \Log::error($e);
            return "";
        }

        return $result;
    }

    static function upload_url($url, $dir, $filename, $width = false, $height = false){
		$url = str_replace(' ', '%20', $url);
		try {
			$storage = Storage::disk('ftp');
	        $path = "{$dir}/{$filename}.jpg";
			if ($width || $height) {
				if (!is_dir('temp')) {
	                mkdir('temp', 0777);
	            }
				$temp = "temp/{$filename}.jpg";
				$w = $width? $width: null;
				$h = $height? $height: null;
				$img = Img::make($url);
				if ($img->width() > $w) {
					$img->resize($w, $height, function ($constraint) {
		                $constraint->aspectRatio();
		            });
				}
				$img->save($temp);
	            if (strlen(config('filesystems.disks.ftp.folder'))) {
					$dir = config('filesystems.disks.ftp.folder')."/{$dir}";
				}
	            if ($storage->putFileAs($dir, new File($temp), $filename)) {
	                $result = "/{$path}";
	            }
	            if (file_exists($temp)) {
	            	unlink($temp);
	            }
			}else{
				$contents = file_get_contents($url);
				if (strlen(config('filesystems.disks.ftp.folder'))) {
					$dir = config('filesystems.disks.ftp.folder')."/{$path}";
				}else{
					$dir = $path;
				}
		        $storage->put($dir, $contents);
		        $result = "/{$path}";
			}
			return $result;
		} catch (\Exception $e) {
			return false;
		}
	}


    private static function rand_string($length)
    {
        $str = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {

            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }


    static function delete_image($path){
        try {
            if($path==""){
                return;
            }

            if (strpos($path, '//') > -1) {
            }else{
                if (!empty(config('filesystems.disks.ftp.url'))){
                    Storage::disk('ftp')->delete(config('filesystems.disks.ftp.folder').$path);
                }
                else{
                    Storage::disk('public')->delete(config('filesystems.disks.public.folder').$path);
                }


            }
        } catch (\Exception $e) {
        }


    }

    public static function UploadImage($request, $field)
    {

        // Handle File Upload
        $fileNameToStore = "";
        if ($request->hasFile($field)) {

            // Get filename with the extension
            $filenameWithExt = $request->file($field)->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file($field)->getClientOriginalExtension();
            // Filename to store
            $pathSave = '/storage/images/';
            $fileNameToStore = self::rand_string(10) . '_' . time() . '.' . $extension;

            // Upload Image
            $moveSuccess = $request->file($field)->move(public_path($pathSave), $fileNameToStore);

            if ($moveSuccess) {
                return $fileNameToStore = $pathSave . $fileNameToStore;
            } else {
                error_log("Error moving file: " . $filename);
            }
        }
        return $fileNameToStore;
    }
    public static function resize_crop_image($max_width, $max_height, $source_file, $dst_dir,$filename,$keepOrginExtention, $quality = 100){
        try{
            if($keepOrginExtention==true){
                $extension = $source_file->getClientOriginalExtension();
            }
            else{
                $extension = 'jpg';
            }
            $filename .= ".{$extension}";
            $path = "{$dst_dir}/{$filename}";
            $imgsize = getimagesize($source_file);
            $width = $imgsize[0];
            $height = $imgsize[1];
            $mime = $imgsize['mime'];

            // dd($mime,$source_file);

            if($max_width == null){
                $max_width = $width;
            }
            if($max_height == null){
                $max_height = $height;
            }
            switch($mime){
                case 'image/gif':
                    $image_create = "imagecreatefromgif";
                    $image = "imagegif";
                    break;

                case 'image/png':
                    $image_create = "imagecreatefrompng";
                    $image = "imagepng";
                    $quality = 7;
                    break;

                case 'image/jpeg':
                    $image_create = "imagecreatefromjpeg";
                    $image = "imagejpeg";
                    $quality = 80;
                    break;

                default:
                    return false;
                    break;
            }

            // dd($imgsize,$image_create,$image);

            $dst_img = imagecreatetruecolor($max_width, $max_height);



            #fill nền trong suốt cho png
            imagealphablending( $dst_img, false );
            imagesavealpha( $dst_img, true );


            #fill nền trắng nếu cần
            #$whiteBackground = imagecolorallocate($dst_img, 255, 255, 255);
            #imagefill($dst_img,0,0,$whiteBackground);

            $src_img = $image_create($source_file);

            $width_new = $height * $max_width / $max_height;
            $height_new = $width * $max_height / $max_width;
            if($width_new > $width){
                $h_point = (($height - $height_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
            }else{
                $w_point = (($width - $width_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
            }
            $path_url = storage_path('app/public/'.$path);
            $result = $image($dst_img,$path_url,$quality);
            if($dst_img)imagedestroy($dst_img);
            if($src_img)imagedestroy($src_img);
            if($result){
                return $path;
            }
            else{
                return "";
            }
        }
        catch (\Exception $e) {
            \Log::error($e);
            throw $e;
            return "";
        }

    }
    static function upload_image($files = false, $dir = 'images', $filename="", $width = false, $height = false,$keepOrginExtention=false){
        if(auth()->check()){
            $dir = $dir.'/'.Str::lower(Helpers::Encrypt(Auth::user()->id,config('module.user.key_sha256')));
        }
        if (!is_dir(storage_path('app/public/'.$dir))) {
            mkdir(storage_path('app/public/'.$dir), 0755);
        }
        if($files===null){
            return "";
        }
        $result= "";
        if(!file_exists($files)){
            $result = MediaHelpers::imageBase64($files,$dir,$filename,$width,$height);
        }
        else{
            $allowedExtensions = array('jpeg', 'jpg', 'png', 'bmp', 'gif', 'ico');
            if($files){
                $extension = strtolower($files->getClientOriginalExtension());
                if(in_array($extension,$allowedExtensions)){
                    $filename=$filename!=""?$filename:self::rand_string(10) . '_' . time();
                    if($extension == 'gif'){
                        $result = MediaHelpers::UploadGif($files, $dir, $filename, $width, $height,$keepOrginExtention);
                    }
                    else{
                        // $result = MediaHelpers::HandleImage($files, $dir, $filename, $width, $height,$keepOrginExtention);
                        $result = MediaHelpers::resize_crop_image($width,$height,$files,$dir,$filename,$keepOrginExtention);
                    }
                }
            }
        }
        return  '/'.$result;





    }
}
