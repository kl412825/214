<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Dd;
class DdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //订单列表
        if($request->od == null){
            if($request->ac != null){
               $arr = Dd::where('dhao','like',"%{$request->input('keyword')}%")->where('ostatus',$request->ac)->orderBy('id','desc') -> paginate($request->input('num',10)); 
                return view('admin/dd/list',['arr'=>$arr,'request'=>$request,'ac'=>$request->ac]); 
            }else{
                $arr = Dd::where('dhao','like',"%{$request->input('keyword')}%")->orderBy('id','desc') -> paginate($request->input('num',10)); 
                return view('admin/dd/list',['arr'=>$arr,'request'=>$request]);
            }

        }else{
                $day = explode('-',date('Y-m-d'));
                $min=mktime(0,0,0,$day[1],$day[2],$day[0]);
                $max=$min+86400;

           if($request->ac != null){
               $arr = Dd::where('dhao','like',"%{$request->input('keyword')}%")->where('oaddtime','>=',$min)->where('oaddtime','<=',$max)->where('ostatus',$request->ac)->orderBy('id','desc') -> paginate($request->input('num',10)); 
                return view('admin/dd/list',['arr'=>$arr,'request'=>$request,'ac'=>$request->ac]); 
            }else{

                $arr = Dd::where('oaddtime','>=',$min)->where('oaddtime','<=',$max)->where('dhao','like',"%{$request->input('keyword')}%")->orderBy('id','desc') -> paginate($request->input('num',10)); 
                return view('admin/dd/list',['arr'=>$arr,'request'=>$request]);
            }
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "123";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return "155656"; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr = Dd::find($id);
        $arr->oaddtime = date('Y年m月d日 H:i:s',$arr->oaddtime);
        return json_encode($arr);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // var_dump($request->input());
        return "123";
    }
    /**
     * 删除订单
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function del(Request $request){
        $id = $request->input('id');
        $arr=Dd::destroy($id);
        return($arr);
    }
    /**
     * 修改订单
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function up(Request $request){
        $id = $request->input('id');
        
        // return($arr);
        $arr['dhao']=$request->input('dhao');
        $arr['onum']=$request->input('onum');
        $arr['ototal']=$request->input('ototal');
        $arr['oaddress']=$request->input('oaddress');
        $arr['oname']=$request->input('oname');
        $arr['ostatus']=$request->input('ostatus');
        $arr['kdd']=$request->input('kdd');
        $rs=Dd::where('id',$id)->update($arr);
        $arr['id']=$request->input('id');
        if($rs==1){
            return json_encode($arr);
        }else{
            return 0;
        }
    }
    /**
     * 已发货订单
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function gogo(Request $request){
        return view('admin/dd/tjtj');
    }
    /**
     * 查询所有订单信息
     * @return [type] [description]
     */
    function cdd(Request $request){
       $ac = $request->input('ac')??null;
       if($ac==null){
        //当年
           $day = explode('-',date('Y-m-d'));
           $min=mktime(0,0,0,0,0,$day[0]);
           $max=mktime(0,0,0,0,0,$day[0]+1);
           $rs = \DB::select("select ostatus,count(ostatus) num from orders where oaddtime>='{$min}' and oaddtime<='{$max}' group by ostatus");
           $count = \DB::select("select count(ostatus) num from orders where oaddtime>='{$min}' and oaddtime<='{$max}' ");
           $arr[]=round($rs[0]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[1]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[2]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[3]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[4]->num??0/$count[0]->num??0*100,2);
           $arr[]=$rs[0]->num??0;
           $arr[]=$rs[1]->num??0;
           $arr[]=$rs[2]->num??0;
           $arr[]=$rs[3]->num??0;
           $arr[]=$rs[4]->num??0;
           return $arr;
       }else if($ac == 'm'){
           $day = explode('-',date('Y-m-d'));
           $min=mktime(0,0,0,$day[1],0,$day[0]);
           $max=mktime(0,0,0,$day[1]+1,0,$day[0]);
           $rs = \DB::select("select ostatus,count(ostatus) num from  orders  where oaddtime>='{$min}' and oaddtime<='{$max}'  group by ostatus");
           $count = \DB::select("select count(ostatus) num from orders where oaddtime>='{$min}' and oaddtime<='{$max}'");
            $arr[]=round($rs[0]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[1]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[2]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[3]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[4]->num??0/$count[0]->num??0*100,2);
           $arr[]=$rs[0]->num??0;
           $arr[]=$rs[1]->num??0;
           $arr[]=$rs[2]->num??0;
           $arr[]=$rs[3]->num??0;
           $arr[]=$rs[4]->num??0;
           return $arr;
       }else if($ac == 't'){
            $day = explode('-',date('Y-m-d'));
           $min=mktime(0,0,0,$day[1],$day[2],$day[0]);
           $max=$min+86400;
           $rs = \DB::select("select ostatus,count(ostatus) num from  orders  where oaddtime>='{$min}' and oaddtime<='{$max}'  group by ostatus");
           $count = \DB::select("select count(ostatus) num from orders where oaddtime>='{$min}' and oaddtime<='{$max}'");
           if($rs == null){
                $arr=[0,0,0,0,0,0,0,0,0,0];
                return $arr;
           }
           $arr[]=round($rs[0]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[1]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[2]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[3]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[4]->num??0/$count[0]->num??0*100,2);
           $arr[]=$rs[0]->num??0;
           $arr[]=$rs[1]->num??0;
           $arr[]=$rs[2]->num??0;
           $arr[]=$rs[3]->num??0;
           $arr[]=$rs[4]->num??0;
           return $arr;
       }else{
           $day = explode('-',date('Y-m-d'));
           $max=mktime(0,0,0,$day[1],$day[2],$day[0]);
           $min=$max-86400;
           $rs = \DB::select("select ostatus,count(ostatus) num from  orders  where oaddtime>='{$min}' and oaddtime<='{$max}'  group by ostatus");
           $count = \DB::select("select count(ostatus) num from orders where oaddtime>='{$min}' and oaddtime<='{$max}'");
           if($rs == null){
                $arr=[0,0,0,0,0,0,0,0,0,0];
                return $arr;
           }
            $arr[]=round($rs[0]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[1]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[2]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[3]->num??0/$count[0]->num??0*100,2);
           $arr[]=round($rs[4]->num??0/$count[0]->num??0*100,2);
           $arr[]=$rs[0]->num??0;
           $arr[]=$rs[1]->num??0;
           $arr[]=$rs[2]->num??0;
           $arr[]=$rs[3]->num??0;
           $arr[]=$rs[4]->num??0;
           return $arr;
       }
       
    }
}
