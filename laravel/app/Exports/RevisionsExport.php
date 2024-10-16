<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\Auth;

use App\Models\Article;
use App\Models\Revisions;
use App\Models\MediatekaCategories;

class RevisionsExport implements FromView
{
	public function __construct($request)
	{
		$this->date_start = ($request->date_start ? $request->date_start : date('Y-m-d'));
		$this->date_end = ($request->date_end ? $request->date_end : date('Y-m-d'));
	}
	
	# 
    public function view(): View
    {
		
		$min_val = (Revisions::min_val('created_at')->val ? Revisions::min_val('created_at')->val : date("Y-m-d"));
		
		$filter['date_start'] = $this->date_start;
		$filter['date_end'] = $this->date_end;

        
		//$MediatekaCategories = MediatekaCategories::where(\DATA::domen(),1)->orderBy('name_ru')->orderBy('name_en')->get();
		
		
		$MediatekaCategories = MediatekaCategories::whereNotIn('id',[53,54,55,56])->whereNotIn('parent_id',[53,54,55,56])->where(\DATA::domen(),1)->orderBy('name_ru')->orderBy('name_en')->get();
		$MediatekaCategories_for_Events = MediatekaCategories::where(\DATA::domen(),1)->where(function ($query) {$query->where('id', '=', 53)->orWhereIn('parent_id', [53,54,55,56]);})->orderBy('name_ru')->orderBy('name_en')->get();
		
		
		$MediatekaCategories = $MediatekaCategories->merge($MediatekaCategories_for_Events);
		
		//dd($MediatekaCategories);
		
		/*$revisions = Revisions::
			  where('module','mediateka')
			->where('domen',\DATA::domen())
			->where(function($query) use ($filter){
				$query->where([
					['created_at', '>=', $filter['date_start']],
					['created_at', '<=', $filter['date_end'].' 23:59:59'],
				]);
			})
			->distinct('parent_id')
			->get();
			*/
		return view('admin.exports.revisions_full_mediateka', [
            'MediatekaCategories' => $MediatekaCategories,
            'filter' => $filter,
        ]);
    }
	
    /* 
	# Только не нулевые
	public function view(): View
    {
		
		$min_val = (Revisions::min_val('created_at')->val ? Revisions::min_val('created_at')->val : date("Y-m-d"));
		
		$filter['date_start'] = $this->date_start;
		$filter['date_end'] = $this->date_end;

        $revisions = Revisions::
			  where('module','mediateka')
			->where('domen',\DATA::domen())
			->where(function($query) use ($filter){
				$query->where([
					['created_at', '>=', $filter['date_start']],
					['created_at', '<=', $filter['date_end'].' 23:59:59'],
				]);
			})
			->distinct('parent_id')
			->get();
			
		return view('admin.exports.revisions', [
            'revisions' => $revisions,
            'filter' => $filter,
        ]);
    }
	*/
}
