<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Admin\Goods;
use  App\Model\Home\discuss;
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
    	if($da){
    		echo '1';
    	}else{
    		echo '2';
    	}
    }
}
