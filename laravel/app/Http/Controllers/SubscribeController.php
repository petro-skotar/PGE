<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Exports\SubscribeExport;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Subscribe;

class SubscribeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = Subscribe::where(function($query) use ($request)
			{
				// Если поиск по всей базе
				if(!empty($request->table_search)){
					$query->orWhere('email', 'ILIKE', '%' . $request->table_search . '%');
					$query->orWhere('name', 'ILIKE', '%' . $request->table_search . '%');
					$query->orWhere('city', 'ILIKE', '%' . $request->table_search . '%');
					$query->orWhere('site_url', 'ILIKE', '%' . $request->table_search . '%');
					$query->orWhere('position', 'ILIKE', '%' . $request->table_search . '%');
				}

			});

        $all = $q->get();

        $regions =  $all->keyBy('region')->toArray();
        foreach($regions as $region => $region_data){
            $regions[$region] = $all->where('region',$region)->count();
        }

        $active[0] = $all->where('active',0)->count();
        $active[1] = $all->where('active',1)->count();

        /*
        $regions =  $all->groupBy('region')->toArray();
        $cities =  $all->groupBy('city')->toArray();
        $active =  $all->groupBy('active')->toArray();
        */
        $subscribers = $q->where(function($query) use ($request)
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

        })->orderBy('created_at','desc')
          ->orderBy('id','desc')
          ->paginate(20);

        return view('admin/subscribe/subscribers')->with([
			'regions'=>$regions,
			//'cities'=>$cities,
			'active'=>$active,
			'subscribers'=>$subscribers,
			'all'=>$all,
		]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all = Subscribe::get();

        $regions =  $all->where('region','!=','')->groupBy('region')->toArray();
        $cities =  $all->where('city','!=','')->groupBy('city')->toArray();

        $subscribe = new Subscribe;
		return view('admin/subscribe/subscriber')->with([
			'regions'=>$regions,
			'cities'=>$cities,
			'subscribe'=>$subscribe,
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:subscribe,email',
        ]);

        $subscribe = Subscribe::create([
		    'name' => trim($request->name),
		    'email' => mb_strtolower(trim($request->email)),
		    'active' => ($request->active ? $request->active : 0),
		    'region' => ($request->region ? trim($request->region) : ''),
		    'city' => ($request->city ? trim($request->city) : ''),
		    'site_url' => ($request->site_url ? trim($request->site_url) : ''),
		    'position' => ($request->position ? trim($request->position) : ''),
		]);

        $messages_save = 'Создан новый подписчик';
			return redirect()->route('subscribe.index')
				->with('messages_save',$messages_save);

    }

    public function add_subscribe(Request $request)
    {

		if(!empty($request->email)){

			if($u = Subscribe::where('email', request('email'))->first()){
				return 'Вы уже подписаны на рассылку.';
			}

			$subscribe = Subscribe::create([
				'email' => $request->email,
			]);
			$subscribe->save();

			return __('messages.sb_thx');
		} else {
			return __('messages.sb_fail');
		}

    }

    # Экспорт, включая фильтр
	public function export(Request $request)
    {
		return Excel::download(new SubscribeExport($request), 'Subscribers-'.date("Y-m-d").'.xlsx');
    }

    # Включаем у пользователя подписку
	public function check(Request $request)
    {
        if(!empty($request->email)){
            $subscribe = Subscribe::where('email',mb_strtolower(trim($request->email)))->first();
            if(!empty($subscribe)){
                $subscribe->active 	= 1;
                $subscribe->save();
                return view('templates.subscribe.check')->with([
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    # Включаем у пользователя подписку
	public function unsubscribe(Request $request)
    {
        if(!empty($request->email)){
            $subscribe = Subscribe::where('email',mb_strtolower(trim($request->email)))->first();
            if(!empty($subscribe)){
                $subscribe->active 	= 0;
                $subscribe->save();
                return view('templates.subscribe.unsubscribe')->with([
                    'subscribe' => $subscribe
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all = Subscribe::get();

        $regions =  $all->where('region','!=','')->groupBy('region')->toArray();
        $cities =  $all->where('city','!=','')->groupBy('city')->toArray();

        $subscribe = Subscribe::find($id);
		return view('admin/subscribe/subscriber')->with([
			'regions'=>$regions,
			'cities'=>$cities,
			'subscribe'=>$subscribe,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->update_type)){ # сохранение по ajax

			# active
			if(isset($request->active)){
				$subscribe = Subscribe::find($id);
				$subscribe->active 		= ($request->active ? $request->active : 0);
				$subscribe->save();
				return "ajax_update_active";
			}

			return false;

		} else { #Обычное сохранение

			$this->validate($request,[
				'name' => 'required',
                'email' => 'required|email|unique:subscribe,email,'.$id,
			]);

			$subscribe = Subscribe::find($id);

			$subscribe->name 	= trim($request->name);
			$subscribe->email 	= mb_strtolower(trim($request->email));

			$subscribe->active 	= ($request->active ? $request->active : 0);

            $subscribe->region 	= ($request->region ? trim($request->region) : '');
			$subscribe->city 	= ($request->city ? trim($request->city) : '');
			$subscribe->site_url 	= ($request->site_url ? trim($request->site_url) : '');
			$subscribe->position 	= ($request->position ? trim($request->position) : '');

			$subscribe->save();

			$messages_save = 'Сохранено';
			return redirect()->route('subscribe.edit',$id)
				->with('messages_save',$messages_save);

		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscribe::where('id', $id)->delete();
        return redirect()->route('subscribe.index');
    }
}
