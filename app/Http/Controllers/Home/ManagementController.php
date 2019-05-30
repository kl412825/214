<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Management;
use App\Model\Admin\Goods;
class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ac=$request->input('search')??'';
        $rs = Management::where('pid','0')->where('name','like',"%{$ac}%")->paginate($request->input('num',10));
        // var_dump($rs);
        $brr=['开启','关闭'];
        return view('admin.management.management',['arr'=>$rs,'request'=>$request,'brr'=>$brr]);
    }

    /**
     *  
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.management.managementcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr=$request->only('name','pow','status','img');
        if($request->input('ac')=='create' ){
           foreach($arr as $v){
            if($v==null || $v =='') return redirect('/home/management/create');
           }

            $hz = $request->file('img')->getClientOriginalExtension();
            $file = rand(11111,99999).time().'.'.$hz;
            $request->file('img')->move('./uploads/',$file);
            $arr['img']=$file;
            Management::create($arr);
            echo "<script >alert('添加完成!');window.location='/home/management';</script>";
        }else{
            if($request->input('status')==1){
            $rs=Management::find($request->input('id'));
            $pid = $rs->pid;
             $count = count(Management::where('pid',$pid)->where('status','0')->get());
            if($count>=8 && $pid!=0){
                return 0;
            }
            }

            if($request->input('status')){
                $zt=0;
            }else{
                $zt=1;
            }

            $rs = Management::where('id',$request->input('id'))->update(['status'=>$zt]);
            return $rs;
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
        $rs = Management::find($id);
        return view('admin.management.managementupdate',['rs'=>$rs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = Management::find($id);
        $arr = Management::where('pid',$id)->get();
        $brr=['开启','关闭'];
        return view('admin.management.managementz',['rs'=>$rs,'arr'=>$arr,'brr'=>$brr]);
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
        $arr=$request->only('name','pow','status');
           foreach($arr as $v){
            if($v==null || $v =='') return redirect('/home/management');
           }

           if($request->hasFile('img')){
            $hz = $request->file('img')->getClientOriginalExtension();
            $file = rand(11111,99999).time().'.'.$hz;
            $request->file('img')->move('./uploads/',$file);
            $arr['img']=$file;
            $rs = Management::find($id);

            // unlink("./uploads/{$rs->img}");
           }
            
            Management::where('id',$id)->update($arr);
            echo "<script >alert('修改完成!');window.location='/home/management';</script>";
    
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
    }
    /**
     * [dele description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function dele(Request $request)
    {
        //获取id删除
        $id =  $request->input('id');
        $rs = Management::where('id',$id)->delete();
        return $rs;
    }

    /**
     * [select description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function select(Request $request)
    {
        //获取id删除
        $id = $request->input('gid');
        $rs = Goods::select('gname')->where('gstatus','1')->where('id',$id)->first();
        if($rs == null){ 
            return 0; }else{ return $rs;}
    }
    /**
     * [add description]
     * @param Request $request [description]
     */
     public function add(Request $request)
    {
        $rs = $request->except(['_token']);
        $count = count(Management::where('pid',$rs['pid'])->where('status','0')->get());
        if($count>=8){
            return 0;
        }
        
        
        $add = Management::create($rs);
        $add->cococo=$count;
        return $add;
    }
}
