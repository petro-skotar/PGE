<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MediatekaFavorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

	public function favorites(Request $request){
		echo "Список избранных";
	}

	public function add_favorites(Request $request){
		
		if(!empty($request->mediateka_id) && !empty($request->user_id)){

			if($MediatekaFavorites = MediatekaFavorites::where('mediateka_id', $request->mediateka_id)->where('user_id', $request->user_id)->first()){
				$MediatekaFavorites->delete();
				return 0;
			}
		
			$MediatekaFavorites = MediatekaFavorites::create([
				'mediateka_id' => $request->mediateka_id,
				'user_id' => $request->user_id,
			]);
			$MediatekaFavorites->save();
			
			return 1;
		} else {
			return 'Не удается добавить докуметн в избранное. Попробуйте позже.';			
		}
		
	}
}
