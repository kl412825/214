<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Model\Admin\Balance;
use Session;
class InfoController extends Controller
{
	/**
	 * 我的订单
	 * @return [type] [description]
	 */
    function dd(){
    	return view('home.dd');
    }
    /**
	 * 查询中心首页
	 * @return [type] [description]
	 */
    function xx(){
    	return view('home.xx');
    }
    /**
	 * 我的收藏
	 * @return [type] [description]
	 */
    function collect(){
    	return view('home.xx');
    }
    /**
	 * 我的收藏
	 * @return [type] [description]
	 */
    function balance(){
    	$rs = Balance::where('uid',Session::get("id"))->get();
    	return view('home.balance',['rs'=>$rs]);
    }
    /**
	 * 账户信息
	 * @return [type] [description]
	 */
    function info(){
    	// var_Dump(Session::all());
    	// $rs = User::where('id',)
    	$id = Session::get('id');
    	$rs = User::where('id',$id)->first();
    	return view('home.info',['rs'=>$rs]);
    }
    /**
	 * 收货地址
	 * @return [type] [description]
	 */
    function site(){
    	return view('home.xx');
    }
    function infoupdate(Request $request){
    	$rs = $request->except(['_token','name','old_img','img']);
    	//判断是否上传图片
    	if($request->hasFile('img')){
    		$hz=$request->file('img')->getClientOriginalExtension();
    		$file=rand(11111,99999).time().'.'.$hz;
    		$request->file('img')->move('./uploads/',$file);
    		$rs['profile']="/uploads/".$file;
    		unlink('.'.$request->input('old_img'));
    	}
    	$id = Session::get('id');
    	$yes=User::where('id',$id)->update($rs);
    	// var_dump($yes);

    	return back()->withInput();
    	
    }
    /**
     * 查询自己的收藏是否重复
     * @return [type] [description]
     */
    function selectbalance(Request $request){
    	if(Session::get("id")==null){
    		return 3;
    	}
    	$rs = Balance::where('uid',Session::get("id"))->where('gid',$request->input('gid'))->first();
    	if($rs){
    		return 0;
    	}else{
    		Balance::create(['uid'=>Session::get("id"),'gid'=>$request->input('gid')]);
    		return 1;
    	}
    }

    /**
     * 删除收藏
     * @return [type] [description]
     */
    function delbalance(Request $request){

    	$rs = Balance::where('id',$request->input('id'))->delete();
    	return 1;
    }
    /**
     * 购物车
     * @return [type] [description]
     */
    function cart(Request $request){

    	
    	return view('home.cart');
    }
    
}
