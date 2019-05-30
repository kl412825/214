<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\slideshow;
class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $rs = slideshow::orderBy('id','asc')

            ->where(function($query) use($request){
                //检测关键字
                $gname = $request->input('gname');
                $price = $request->input('price');
                //如果用户名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
                //如果邮箱不为空
                if(!empty($price)) {
                    $query->where('price','like','%'.$price.'%');
                }
            })
            ->paginate($request->input('num', 10));


        return view('admin.show.list',[
            'title'=>'轮播图列表页面',
            'rs'=>$rs,
            'request'=>$request
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.show.create',['title'=>'添加轮播图']);
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
        
        'furl' => 'required',
        'surl' => 'required',

        'furl' => array('regex:/(http?):\/\/(www)\.([^\.\/]+)\.(com|cn)(\/[\w-\.\/\?\%\&\=]*)?/i'),
    ],
    [
       
        'furl.required' => '网址不能为空',
        'furl.regex' => '网址格式不正确',
        'surl.required' => '图片不能为空', 
        
             
    ]); 
      
       $rs = $request->except('_token','surl');
              //商品的图片处理
        if ($request->hasFile('surl')) {

            $files = $request->file('surl');

           
                // $garr['gid'] = $gid;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $files->getClientOriginalExtension();
                //移动
                $files->move('./uploads/show',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $rs['surl'] = "/uploads/show/".$names.'.'.$suffix;
            
        }
       

        try{ 
            //存储轮播的图片
            $res =slideshow::insert($rs) ;

            if ($res) {
                
                return redirect('/admin/show')->with('success','添加成功');
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
         //表单验证
      
        $rs = slideshow::find($id);
        if($rs->status == 0){
            $s['status'] =1;
        }else{
            $s['status']=0;
        }

        $data = slideshow::where('id',$id)->update($s);
         if($data){

            return redirect('/admin/show')->with('success','状态修改成功');
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

        $rs = slideshow::find($id);
        return view('admin.show.edit',['title'=>'修改轮播图','rs'=>$rs]);
        
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
           //表单验证
        $this->validate($request, [
        
        'furl' => 'required',
        'surl' => 'required',

        'furl' => array('regex:/(http?):\/\/(www)\.([^\.\/]+)\.(com|cn)(\/[\w-\.\/\?\%\&\=]*)?/i'),
    ],
    [
       
        'furl.required' => '网址不能为空',
        'furl.regex' => '网址格式不正确',
        'surl.required' => '图片不能为空', 
        
             
    ]); 
         $res = slideshow::find($id);
         @unlink('.'.$res->surl);
        $rs = $request->except('_token','surl','_method');
         //图片处理
        if ($request->hasFile('surl')) {

            $files = $request->file('surl');

           
                // $garr['gid'] = $gid;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $files->getClientOriginalExtension();
                //移动
                $files->move('./uploads/show',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $rs['surl'] = "/uploads/show/".$names.'.'.$suffix;
            
        }
       

        try{ 
            //存储轮播的图片
            $res =slideshow::where('id',$id)->update($rs) ;

            if ($res) {
                
                return redirect('/admin/show')->with('success','修改成功');
            }

        }catch(\Exception $e){
            
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
         $res = slideshow::find($id);
         @unlink('.'.$res->surl);
         $rs = slideshow::where('id',$id)->delete();
        if($rs){

            return redirect('/admin/show')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');
        }

    }
}
