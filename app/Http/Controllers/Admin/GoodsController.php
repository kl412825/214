<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use  App\Model\Admin\Goods;
use App\Model\Admin\img;

use App\Http\Requests\GoodRequest;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
               //
        $rs = Goods::orderBy('id','asc')

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
                    $query->where('gprice','like','%'.$price.'%');
                }
            })
            ->paginate($request->input('num', 10));


        return view('admin.goods.list',[
            'title'=>'商品的列表页面',
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
        $rs = DB::table('type')->orderByRaw("concat(path,id,',')")->get();
       return view('admin.goods.create',['title'=>'添加商品','rs'=>$rs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodRequest $request)
    {
        //表单验证
       
         $rs = $request->except('_token','gpic');
         $rs['gaddtime'] = time();
        $data = Goods::create($rs);

        //商品的图片处理
        if ($request->hasFile('gpic')) {

            $files = $request->file('gpic');

            $gs = [];
            //遍历
            foreach($files as $k => $v){
                $garr = [];
                // $garr['gid'] = $gid;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $v->getClientOriginalExtension();
                //移动
                $v->move('./uploads/gimgs',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $garr['gpic'] = "/uploads/gimgs/".$names.'.'.$suffix;
                //第一种方式
                // $gs[] = $garr;

                //第二种方式
                array_push($gs,$garr);
            }
        }
       

        try{ 
            //存储商品的图片
            $res = $data->gm()->createMany($gs);

            if ($res) {
                
                return redirect('/admin/good')->with('success','添加成功');
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
            //根据id 删除图片存放的位置
        $res = img::find($id);

        $data = @unlink('.'.$res->gpic);

        if(!$data){

            echo '删除路径图片失败';
        }

        //根据id获取信息
        $rs = img::where('id',$id)->delete();

        if($rs){

            echo 1;
        } else {

            echo 0;
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
        //获取关联表的商品图片信息
        //一对多的查询  只查询关联的信息
       
         $rs = DB::table('type')->orderByRaw("concat(path,id,',')")->get();

        $res = Goods::find($id);
         $gs = $res->gm()->get();
        return view('admin.goods.edit',['title'=>'修改商品','rs'=>$rs,'res'=>$res,'gs'=>$gs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoodRequest $request, $id)
    {
        $rs = $request->except('_token','gpic','_method');
        $rs['gaddtime'] = time();
        $data = Goods::where('id',$id)->update($rs);
              //商品的图片处理
        if ($request->hasFile('gpic')) {

            $files = $request->file('gpic');

            $gs = [];
            //遍历
            foreach($files as $k => $v){
                $garr = [];
                $garr['gid'] = $id;
                //更改名
                $names = 'gimg_'.rand(1111,9999).time();
                //获取后缀
                $suffix = $v->getClientOriginalExtension();
                //移动
                $v->move('./uploads/gimgs',$names.'.'.$suffix);
                //保存的是商品图片的路径
                $garr['gpic'] = "/uploads/gimgs/".$names.'.'.$suffix;
                //第一种方式
                // $gs[] = $garr;

                //第二种方式
                array_push($gs,$garr);
            }
        }

        //添加商品的关联图片
        $res = DB::table('goodsimg')->insert($gs);

        if($res){

            return redirect('/admin/good')->with('success','修改成功');
        } else {

             return redirect('/admin/good')->with('success','修改失败');
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
          //删除图片的路径信息
        $rs = img::where('gid',$id)->get();

        foreach($rs as $k => $v){

            @unlink('./'.$v->gpic);
        }
        
        $gm = Goods::find($id);

        $gm->delete();

        $res = $gm->gm()->delete();

        if($res){

            return redirect('/admin/good')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');
        }
    }
    /**
     * 状态
     * 
     */
    public function sta($id)
    {
       $rs = Goods::find($id);
        if($rs->gstatus == 0){
            $s['gstatus'] =1;
        }else{
            $s['gstatus']=0;
        }

        $data = Goods::where('id',$id)->update($s);
         if($data){

            return redirect('/admin/good')->with('success','状态修改成功');
        } else {

            return back()->with('error','状态修改失败');
        }

    }

    /**
     * 商品详情
     */
    public function xq($id)
    {

        $rs = Goods::find($id);
        
        $gs = $rs->gm()->get();
        
        return view('admin.goods.xq',[
            'title'=>'商品详情页',
            'rs'=>$rs,
            'gs'=>$gs
            
        ]);
    }
}
