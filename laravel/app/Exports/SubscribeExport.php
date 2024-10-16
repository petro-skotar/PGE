<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Subscribe;

class SubscribeExport implements FromView
{
	public $request;

    public function __construct(Request $request)
	{
        $this->request = $request;
	}

    public function view(): View
    {
        $request = $this->request;
        $subscribers = Subscribe::where(function($query) use ($request){
            // Если поиск по всей базе
            if(!empty($request->table_search)){
                $query->orWhere('email', 'ILIKE', '%' . $request->table_search . '%');
                $query->orWhere('name', 'ILIKE', '%' . $request->table_search . '%');
                $query->orWhere('city', 'ILIKE', '%' . $request->table_search . '%');
                $query->orWhere('site_url', 'ILIKE', '%' . $request->table_search . '%');
                $query->orWhere('position', 'ILIKE', '%' . $request->table_search . '%');
            }
        })->where(function($query) use ($request)
        {



            // фильтр по региону
            if(!empty($request->r)){
                if($request->r == 'no'){
                    $query->where('region', '');
                } else {
                    $query->where('region', $request->r);
                }
            }

            // фильтр по месту
            if(!empty($request->c)){
                if($request->c == 'no'){
                    $query->where('city', '');
                } else {
                    $query->where('city', $request->c);
                }
            }

            // фильтр по активности
            if(!empty($request->a)){
                if($request->a == 'no'){
                    $query->where('active', 0);
                } else {
                    $query->where('active', $request->a);
                }
            }

        })->orderBy('created_at','desc')->get();
		return view('admin.subscribe.export', [
            'subscribers' => $subscribers,
        ]);
    }
}
