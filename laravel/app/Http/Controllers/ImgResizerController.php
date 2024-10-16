<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Mediateka;
use App\Models\Lang;
use Image;
use File;

class ImgResizerController extends Controller
{
    public function getImg($module, $code, $w=200){
		if($module == 'mediateka_preview'){
			$module = 'mediateka/preview';
		}
		Storage::disk('public')->makeDirectory('cache/' . $module);
		if(File::exists("./storage/cache/$module/$code-$w.jpg")){
			$img = Image::make("./storage/cache/$module/$code-$w.jpg");
			return response()->file("./storage/cache/$module/$code-$w.jpg");
		} else {
			//dd(22);
			if(File::exists("./storage/$module/$code.jpg")){
				$filetype = 'jpg';
			} else if(File::exists("./storage/$module/$code.jpeg")){
				$filetype = 'jpeg';
			} else if(File::exists("./storage/$module/$code.png")){
				$filetype = 'png';
			} else if(File::exists("./storage/$module/$code.gif")){
				$filetype = 'gif';
			} else if(File::exists("./storage/$module/$code.webp")){
				$filetype = 'webp';
			} else {				
				return '';
			}
			if($filetype){
				$img = Image::make("./storage/$module/$code.$filetype")->resize($w, null, function ($constraint) {
					$constraint->aspectRatio();
				});
				$img->save(storage_path() . '/app/public/cache/'.$module.'/'.$code.'-'.$w.'.jpg');
				return Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
			}
		}
	}
}
