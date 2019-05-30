<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use DB;




use App\Model\Admin\type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


        //
    public function index(Request $request)
    {
    	//获取传过来的数据搜索名字
    	$se = $request->search;
    	//获取数据按path排序
        $rs = DB::table('type')->orderByRaw("concat(path,id,',')")->where('tname','like','%'.$se.'%')->paginate($request->input('num',10));
        return view('admin.type.list',['rs'=>$rs,'title'=>'商品类别','request'=>$request]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       

    	//排序
    	$rs = DB::table('type')->orderByRaw("concat(path,id,',')")->get();
 
        return view('admin.type.create',
                ['title'=>'商品类别添加',
                	'rs'=>$rs

            	]

            );
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

    	//验证
    	$this->validate($request, [
		    'tname' => 'required|unique:type',
		   
		], [
        'tname.required' => '商品类别不能为空',
        'tname.unique'  => '类别已存在',
     
    ]);
    	$rs = DB::table('type')->where('tname','=',$request->tname)->first();
    	if ($rs) {
    		//存在
     		return back()->with('success','已经存在');
 		}

        $data = $request->except('_token');
        if($data['pid'] =='0' ){
        	$data['path']='0,';
        }else{
        	$data['path'] =  DB::table('type')->where('id',$data['pid'])->first()->path.$data['pid'].',';
        }
      
       
         try{
           
             $db = DB::table('type')->insert($data);

            if($db){

                return redirect('/admin/type')->with('success','添加成功');
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

       $rs = type::find($id);

       $all = type::where('pid',$id)->get();
       foreach ($all as $k => $v) {
          if($v->status == 1){
            $st['status'] =0;
          }else{
            $st['status'] =1;
          }
          $da = type::where('id',$v->id)->update($st);
       }
       if($rs->status == 1){
        $a['status'] =0;
       }else{
        $a['status']=1;
       }
         $data = type::where('id',$id)->update($a);
         if($data){

            return redirect('/admin/type')->with('success','状态修改成功');
        } else {

            return back()->with('error','状态修改失败');
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

        $rs = DB::table('type')->where('id',$id)->first();
        
        return view('admin.type.edit',['title'=>'修改页','rs'=>$rs]);

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

        // var_dump($id);
        $arr = $request->except('_token','_method');
        // var_dump($arr);die;
        $rs = DB::table('type')->where('id', $id)->update($arr);
        if($rs){
        	return redirect('/admin/type')->with('success','修改成功');
        }else{
        	return back()->with('success','修改失败');
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
    

    	//如果有子类不能删
    	$cate = DB::table('type')->where('pid','=',$id)->first();

    	if(!empty($cate)){
    		return redirect('/admin/type')->with('success','下面有子类不能删除');
    	}else{
    		$rs = DB::table('type')->where('id',$id)->delete();
    		return back()->with('success','删除成功');
    	}
    	
        
    }
    /**
     * 添加子类
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public function ty($id = 0)
    {
        $rs = DB::table('type')->orderByRaw("concat(path,id,',')")->get();

        return view('admin.type.ty',['title'=>'添加子类','rs'=>$rs,'id'=>$id]);
    }
    /**
     *  无限极分类的递归
     *
     * @return \Illuminate\Http\Response
     */
    public static function getfenleiMessage($pid)
    {
         //获取顶级的分类
        $cate = type::where('pid',$pid)->get();
        
        $arr = [];

        foreach($cate as $k=>$v){

            if($v->pid==$pid){

                $v->sub=self::getfenleiMessage($v->id);

                $arr[]=$v;
            }
        }  
        return $arr;
    }
    //获取无限极分类的递归
    // public function demo()
    // {
    //     $res = self::getfenleiMessage(0);

    //     dump($res);
    // }

}
