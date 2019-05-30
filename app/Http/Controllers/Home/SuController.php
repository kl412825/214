<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Admin\Goods;
use  App\Model\Home\discuss;
use  App\Model\Home\user;
class SuController extends Controller
{
	/**
	 * 搜索
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function su(Request $request)
    {
    	
    	$rs = Goods::where('gname','like','%'.$request->name.'%')->get();
    	$ty = count($rs);
    	return view('home.su',['title'=>'搜索页','ty'=>$ty,'rs'=>$rs]);
    }

    public function pl(Request $request)
    {
    	$rs = $request->all();
    	$rs['addtime']=time();
    	$rs['uid'] = session('id');
        
    	$da = discuss::create($rs);
        $da['addtime'] = date('Y-m-d H:i:s',$da['addtime']);

        $y = user::where('id',$da['uid'])->first();
        $da['img'] =$y->profile;
        $da['uid'] =$y->uname;
    	if($da){
    		return json_encode($da);
    	}else{
    		echo '2';
    	}
    }
    public function hf(Request $request)
    {
     
        $rs = $request->all();
        $rs['addtime']=time();
        $rs['uid'] = session('id');

        $rs['path']= '0,'.$rs['path'].',';
        $da = discuss::create($rs);
        if($da){
            echo 1;
        }else{
            echo 2;
        }
    }

}
