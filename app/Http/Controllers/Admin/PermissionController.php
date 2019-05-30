<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rs = Permission::where('pername','like','%'.$request->pername.'%')->paginate($request->input('num',10));

        return view('admin.permission.list',['title'  => '角色列表','rs' => $rs,'request' => $request]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permission.create',['title' => '添加权限']);
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
        $rs = $request->except('_token');

        try{
       		$data = Permission::create($rs);
       		if($data){
       			return redirect('/admin/permission')->with('success','添加成功');
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
         $rs = Permission::find($id);

        return view('admin.permission.edit',['title' => '修改角色','rs' => $rs]);
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
        $res = Permission::where('perurl',$rs['perurl'])->get();
        if($res){
        	return back()->with('error','该权限路径已存在');
        }

        $data = Permission::where('id',$id)->update($rs);

        if($data){
        	return redirect('/admin/permission')->with('success','修改成功');
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
        $data = Permission::destroy($id);


        if($data){
        	return redirect('/admin/permission')->with('success','删除成功');
        }else{
        	return back()->with('error','删除失败');
        }
    }
}
