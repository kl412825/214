<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Firend;

class FirendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rs = Firend::where('fname','like','%'.$request->fname.'%')->paginate($request->input('num',10));

        return view('admin.firend.list',['title'  => '友情列表','rs' => $rs,'request' => $request]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.firend.create',['title' => '添加友情']);
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
        //表单验证
    	$this->validate($request, [
        'fname' => 'required|unique:firend',
        'furl' => 'required|unique:firend',
        'furl' => array('regex:/(http?):\/\/(www)\.([^\.\/]+)\.(com|cn)(\/[\w-\.\/\?\%\&\=]*)?/i'),
    ],
    [
       
        'fname.required' => '网站名不能为空',
        'fname.unique' => '网站名已存在',
        'furl.required' => '网址格式不正确', 
        'furl.regex' => '网址格式不正确', 
             
    ]); 
        $rs = $request->except('_token');
        $rs['faddtime'] = time();
        
        try{
           	$data = Firend::create($rs);
      
        if($data){

                return redirect('/admin/firend')->with('success','添加成功');
            }
        }catch(\Exception $e){

            return back()->with('error','该网址已存在');

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
        $rs = Firend::find($id);
       	if($rs->status == 0)
       	{
       		$rs->status = 1;
       	}else{
       		$rs->status = 0;
       	}
        $data = Firend::where('id',$rs->id)->update(['status' => $rs->status]);
        if($data){
        	return redirect('/admin/firend')->with('success','修改成功');
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
        $rs = Firend::find($id);

        return view('admin.firend.edit',['title' => '修改友情','rs' => $rs]);
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
        //
        $this->validate($request, [
        'fname' => 'required|unique:firend',
        'furl' => 'required',
        'furl' => array('regex:/(http?):\/\/(www)\.([^\.\/]+)\.(com|cn)(\/[\w-\.\/\?\%\&\=]*)?/i'),
    ],
    [
       
        'fname.required' => '网站名不能为空',
        'fname.unique' => '网站名已存在',
        'furl.regex' => '网址格式不正确', 
             
    ]);
         $rs = $request->except('_token','_method');
        
           	 $data = Firend::where('id',$id)->update($rs);
      
	        if($data){

                return redirect('/admin/firend')->with('success','修改成功');
            }else{
        		return back()->with('error','网站名或网址已存在');

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
        $data = Firend::destroy($id);

        if($data){
        	return redirect('/admin/firend')->with('success','删除成功');
        }else{
        	return back()->with('error','删除失败');
        }    
    }
}
