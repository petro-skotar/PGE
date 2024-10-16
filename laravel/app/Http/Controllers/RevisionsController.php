<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revisions;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RevisionsExport;
use Carbon\Carbon;
use Config;

class RevisionsController extends Controller
{
    public $type_visit = [
		'views' => 'v',
		'downloads' => 'd',
	];
	
	public function index(Request $request){
		
		//$MinDate = $this->getMinDate($type);
		
		$min_val = (Revisions::min_val('created_at')->val ? Revisions::min_val('created_at')->val : date("Y-m-d"));
		$min_val = date("Y-m-d", strtotime($min_val));
		
		$filter['parent_id'] = ($request->parent_id ? $request->parent_id : 0);
		$filter['user_id'] = ($request->user_id ? $request->user_id : 0);
		$filter['date_start'] = ($request->date_start ? $request->date_start : $min_val);
		$filter['date_end'] = ($request->date_end ? $request->date_end : date("Y-m-d"));

        $revisions = Revisions::
			  where('module','mediateka')
			
			->where(function($query) use ($filter){
				$query->where([
					['created_at', '>=', $filter['date_start']],
					['created_at', '<=', $filter['date_end'].' 23:59:59'],
				]);
			})
			->distinct('parent_id')
			->paginate(30);
			
		return view('admin/revisions/revisions')->with([
			'revisions'=>$revisions,
			'filter'=>$filter,
		]);
	}
	
	# Экспорт статистики
	public function export(Request $request) 
    {
		return Excel::download(new RevisionsExport($request), 'Статистика просмотров на сайте '.Config::get('cms.sites.'.DATA::mode().'.site_name').' c '.$request->date_start.' по '.$request->date_end.'.xlsx');
    }
	
	public function details($parent_id, Request $request){
		$MinDate = $this->getMinDate($type);

		$filter['parent_id'] = ($request->parent_id ? $request->parent_id : 0);
		$filter['user_id'] = ($request->user_id ? $request->user_id : 0);
		$filter['date_start'] = ($request->date_start ? $request->date_start : '');
		$filter['date_end'] = ($request->date_end ? $request->date_end : '');
		$date_start = '';
		$date_end = '';
		
        $revisions = Revisions::
			  where('parent_id',$parent_id)
			
			->where('type_visit',$this->type_visit[$type])
			->orderBy('created_at','desc')
			->paginate(50);
				
		return view('admin/revisions/revisions')->with([
			'revisions'=>$revisions,
			'type'=>$type,
			'filter'=>$filter,
		]);
	}
	public function objects($id, Request $request){
		echo 'objects-'.$id;
	}
	public function users($id, Request $request){
		echo 'users-'.$id;
	}
	
	# Даты создания
	public function getMinDate($type)
    {
		$revisions = Revisions::selectRaw(" MIN(created_at) AS min")
			->where('module','mediateka')
			
			->where('type_visit',$this->type_visit[$type])
			->first();
		return $revisions->min;;
    }
	
}
