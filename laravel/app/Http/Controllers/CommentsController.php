<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Comments;

class CommentsController extends Controller
{
	
	# Добавление коментария
	public function add_comments(Request $request){
		
		if(!empty($request->comment) && isset($request->user_id) && isset($request->name) && isset($request->page_id) && isset($request->module)){
			
			$active = 1; // Пока отображаем все
			if(!empty($request->user_id)){
				$active = 1;
			}
			
			$parent_id = 0;
			if(!empty($request->parent_id)){
				$parent_id = $request->parent_id;
			}
			
			$comment = Comments::create([
				'comment' => $request->comment,
				'user_id' => $request->user_id,
				'name' => $request->name,
				'page_id' => $request->page_id,
				'module' => $request->module,
				'active' => $active,
				'parent_id' => $parent_id,
				'ip' => $request->ip(),
			]);
			$comment->save();
			
			if($request->module == 'mediateka'){
				return redirect()->route('viewDocument',$request->page_id);
			} elseif($request->module == 'articles'){
				$article = Article::where('id',$request->page_id)->first();
				if($article->module == 'articles'){
					return redirect()->route('viewArticle',$article->url);
				}elseif($article->module == 'news'){
					return redirect()->route('viewNewsItem',$article->url);
				}elseif($article->module == 'events'){
					return redirect()->route('viewEventsItem',$article->url);
				}elseif($article->module == 'tender'){
					return redirect()->route('viewTenderItem',$article->url);
				}elseif($article->module == 'uchastniki-aml'){
					return redirect()->route('viewUchastnikiamlItem',$article->url);
				}elseif($article->module == 'uchastniki-pfr'){
					return redirect()->route('viewUchastnikipfrItem',$article->url);
				}
			} else {
				return redirect()->route('index');
			}
		} else {
			$data_errors = 'Ошибка. <br>К сожалению мы не можем добавить ваш комментарий. Проверьте введенные вами данные и отправьте комментарий еще раз. Если ошибка повториться, то обратитесь к администратору сайта.';
			if($request->module == 'mediateka'){
				return redirect()->route('viewDocument',$request->page_id)->withInput()->with('data_errors',$data_errors);
			} elseif($request->module == 'articles'){
				
				$article = Article::where('id',$request->page_id)->first();
				if($article->module == 'articles'){
					return redirect()->route('viewArticle',$article->url)->withInput()->with('data_errors',$data_errors);
				}elseif($article->module == 'news'){
					return redirect()->route('viewNewsItem',$article->url)->withInput()->with('data_errors',$data_errors);
				}elseif($article->module == 'events'){
					return redirect()->route('viewEventsItem',$article->url)->withInput()->with('data_errors',$data_errors);
				}elseif($article->module == 'tender'){
					return redirect()->route('viewTenderItem',$article->url)->withInput()->with('data_errors',$data_errors);
				}elseif($article->module == 'uchastniki-aml'){
					return redirect()->route('viewUchastnikiamlItem',$article->url)->withInput()->with('data_errors',$data_errors);
				}elseif($article->module == 'uchastniki-pfr'){
					return redirect()->route('viewUchastnikipfrItem',$article->url)->withInput()->with('data_errors',$data_errors);
				}				
				
			} else {
				return redirect()->route('index');
			}
		}
		
	}
	
	# Удаление коментария
	public function remove_comment(Request $request){
		
		# Удалять может:
		# 	- админ с правами на комменты
		# 	- юзер, id которго совпадает с user_id коммента  
		# 	- юзер если IP совпадает, 
		
		if(!empty($request->id)){

			$comment = Comments::where('id',$request->id)->first();
			
			if(
				(!empty(Auth::user()->id) && Auth::user()->roles_open_modules(Auth::user()->role_id,'comments'))
				|| (!empty(Auth::user()->id) && Auth::user()->id == $comment->user_id)
			){
				// Удаляем
				$comment->delete();
				//dd('Удаляем', $comment);
				return 1;
			} else {
				//return "У вас не достаточно прав";
				return 0;
			}
		
		} else {
			//return "Нет такого коммента";
			return 0;
		}
		
	}
}
