<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
	# Модули
	protected function modules(){
		return array(
			'custom' => 'Общий',
		);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::orderBy('id')->get();

		return view('admin/setting/list')->with([
			'setting'=>$setting
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = new Setting;

		return view('admin/setting/item')->with([
			'setting'=>$setting,
			'modules'=>$this->modules(),
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
			'desc' => 'required',
			'code' => 'required',
		]);
        $setting = Setting::create([
		    'desc' => $request->desc,
		    'val' => ($request->val ? $request->val : ''),
		    'code' => $request->code,
		    'module' => $request->module,
		]);
        if($request->hasFile('files')) {
			$files = [];
			foreach($request->file('files') as $image){
                Storage::disk('public')->put(DATA::module().'/'.$image->getClientOriginalName(), file_get_contents($image));
				$files[] = DATA::module().'/'.$image->getClientOriginalName();
			}
			$setting->files = $files;
		}
	    $setting->save();

		return redirect()->route('setting.index');
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
		$setting = Setting::find($id);
		return view('admin/setting/item')->with([
			'setting'=>$setting,
			'modules'=>$this->modules(),
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
        $this->validate($request,[
			'desc' => 'required',
			'code' => 'required',
		]);

    	$setting = Setting::find($id);

		$setting->desc = $request->desc;
		$setting->val = $request->val;
		$setting->code = $request->code;
		$setting->module = $request->module;

        $files = $setting->files;
        if(isset($request->files_remove) && !empty($files)){
            foreach($request->files_remove as $index=>$val){
                unset($files[$index]);
            }
            $files = array_values($files);
            $setting->files = $files;
        }
        if($request->hasFile('files')) {
            foreach($request->file('files') as $image){
                Storage::disk('public')->put(DATA::module().'/'.$image->getClientOriginalName(), file_get_contents($image));
				$files[] = DATA::module().'/'.$image->getClientOriginalName();
            }
            $files = array_values($files);
        }
        $setting->files = $files;

		$setting->save();

		if(isset($request->desc)){
			$messages_save = 'Data saved.';
			return redirect()->route('setting.edit',$id)
				->with('setting',$setting)
				->with('messages_save',$messages_save);

		} elseif(isset($request->active)){
			return "ajax_update_active";
		} else {
			return false;
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
        Setting::where('id', '=', $id)->delete();

        return redirect()->route('setting.index');
    }
}
