<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mediateka;
use App\Models\Setting;

class ShortcodeController extends Controller
{

    public static function shortcode($code = 'video', $id)
    {
		if($code == 'video'){
			$document = Mediateka::where(DATA::domen(),1)
				->where('id',$id)
				->where('category_type','video')
				->first();
			if(!empty($document)){
				$oncontextmenu = ($document->only_view ? 'oncontextmenu="return false;"' : '');
				return '<div class="vs_video">
							<video '.$oncontextmenu.'  preload="none" id="player_'.$document->id.'" controls="true" disablepictureinpicture playsinline controlsList="nodownload noremoteplayback noplaybackrate">
								<source src="'.route('download_files',$document->code()).'" type="video/mp4">
							</video>
							<a href="" data-id="'.$document->id.'" style=" background-image: url('.($document->filepreview ? route('getImg',['mediateka_preview', $document->preview_code(), 700]) : asset('templates/'.DATA::domen().'/img/temp_file.svg')).');"></a>
						</div><br>';
			}
			return '';
		}
		if($code == 'setting'){
			$setting = Setting::where('code',$id)->first();
			if(!empty($setting)){
				//return $files->store('setting','public');
				if(!empty($setting->files)){
					return asset('storage/'.$setting->files[0]);
				} elseif(!empty($setting->val)){
					return $setting->val;
				} else {
					return '';
				}
			}
			return '';
		}
    }
}
