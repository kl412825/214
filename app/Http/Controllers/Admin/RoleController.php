<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;
use DB;

class RoleController extends Controller
{
	/**
     * 角色权限的添加页面
     *
     * @return \Illuminate\Http\Response
     */
	public function role_per(Request $request)
	{
		//获取角色的id
		$rid = $request->rid;

		//查找角色名
		$res = Role::find($rid);

		//获取所有权限信息
		$pers = Permission::all();


		//根据角色查找权限
		$rp = $res->role_per()->get();
		$arr = [];
		foreach($rp as $k=>$v){
			$arr[] = $v->id;
		}


		return view('admin.role.roleper',[
			'title' => '角色权限的添加页面',
			'res' => $res,
			'pers'=>$pers,
			'arr' =>$arr
		]);
	}

	/**
     * 角色和权限的方法
     *
     * @return \Illuminate\Http\Response
     */

	public function doroleper(Request $request)
	{

		//获取角色id
		$rid = $request->rid;

		DB::table('role_per')->where('roleid',$rid)->delete();

		//获取权限id
		$perid = $request->perid;

		$prr = [];
		//遍历权限id的
		foreach($perid as $k => $v){
			$arr = [];
			$arr['roleid'] = $rid;
			$arr['perid'] = $v;
			$prr[] = $arr;
		}

		//往role_per表里面添加数据 
		$data = DB::table('role_per')->insert($prr);

		if($data){
			return redirect('/admin/role')->with('success','权限添加成功');
		}else{
			return back()->with('error','权限添加失败');
		}

	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rs = Role::where('rolename','like','%'.$request->rolename.'%')->paginate($request->input('num',10));

        return view('admin.role.list',['title'  => '角色列表','rs' => $rs,'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.create',['title' => '添加角色']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
       	$rs = $request->except('_token');
       	try{
       		$data = Role::create($rs);
       		if($data){
       			return redirect('/admin/role')->with('success','添加成功');
       		}
       	}catch(\Exception $e){
       		return back()->with('error','添加失败');
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
        $rs = Role::find($id);
       	if($rs->status == 0)
       	{
       		$rs->status = 1;
       	}else{
       		$rs->status = 0;
       	}
        $data = Role::where('id',$rs->id)->update(['status' => $rs->status]);
        if($data){
        	return redirect('/admin/role')->with('success','修改成功');
        }else{
        	return back()->with('error','修改失败');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rs = Role::find($id);

        return view('admin.role.edit',['title' => '修改角色','rs' => $rs]);
        
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
        //

        $rs = $request->except('_token','_method');

        $data = Role::where('id',$id)->update($rs);

        if($data){
        	return redirect('/admin/role')->with('success','修改成功');
        }else{
        	return back()->with('error','修改失败');
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
        //
        $data = Role::destroy($id);

        if($data){
        	return redirect('/admin/role')->with('success','删除成功');
        }else{
        	return back()->with('error','删除失败');
        }
    }

    //
    
    public function  rpes(){
    	return view('admin.role.rpes');
    }

}
