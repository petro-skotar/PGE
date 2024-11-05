<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\RolesModules;
use App\Models\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RolesController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$roles = Roles::all();
		$roles = $roles->sortBy('id');

		return view('admin/roles/roles')->with([
			'roles'=>$roles
		]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$role = new Roles;
		$roleRolesArray = array();

		return view('admin/roles/role')->with([
			'role'=>$role,
			'roleRolesArray'=>$roleRolesArray,
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

		$validate_messsages = [
			'name.required'=>'Поле <b>Роль</b> обязательно для заполнения.',
		];
    	$this->validate($request,[
			'name' => 'required',
		], $validate_messsages);
        $role = Roles::create([
		    'name' => $request->name,
		]);
	    $role->save();

		$roleRolesArray = array();
		if(!empty($request->security)){
			foreach ($request->security as $mod){
				$roleRoles = RolesModules::create([
					//'active' => ($request->active ? $request->active : 0),
					'role_id' => $role->id,
					'module' => $mod,
				]);
				$roleRolesArray[] = $mod;
				$roleRoles->save();
			}
		}

	    return redirect()->route('roles.index');
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
        $role = Roles::find($id);

		$roleRolesArray = array();
		$RolesModules = RolesModules::select()->where('role_id',$id)->get();
		foreach($RolesModules as $r){
			$roleRolesArray[]=$r->module;
		}

		return view('admin/roles/role')->with([
			'role'=>$role,
			'roleRolesArray'=>$roleRolesArray,
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
		$validate_messsages = [
			'name.required'=>'Поле <b>Роль</b> обязательно для заполнения.',
		];
		$this->validate($request,[
			'name' => 'required',
		], $validate_messsages);

    	$role = Roles::find($id);

		$role->name = $request->name;

		$role->save();

		$roleRolesArray = array();
		if(isset($request->name)){
			RolesModules::where('role_id',$id)->delete();
			if(!empty($request->security)){
				foreach ($request->security as $mod){
					$roleRoles = RolesModules::create([
						//'active' => ($request->active ? $request->active : 0),
						'role_id' => $id,
						'module' => $mod,
					]);
					$roleRolesArray[] = $mod;
					$roleRoles->save();
				}
			}
		}

		if(isset($request->name)){
			$messages['save'] = 'Data saved.';
			return view('admin/roles/role')->with([
				'role'=>$role,
				'roleRolesArray'=>$roleRolesArray,
				'messages'=>$messages,
			]);
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

        RolesModules::where('role_id', '=', $id)->delete();
        Roles::where('id', '=', $id)->delete();

        return redirect()->route('roles.index');
    }

}
