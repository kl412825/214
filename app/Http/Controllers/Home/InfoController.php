<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Model\Admin\Balance;
use App\Model\Admin\Cart;
use App\Model\Admin\Address;
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

    	$rs = Cart::where('uid',Session::get("id"))->get();
    	return view('home.cart',['rs'=>$rs]);
    }

    /**
     * 加入购物车
     * @return [type] [description]
     */
    function addcart(Request $request){
    	if(Session::get("id")==null){
    		return 3;
    	}
    		$rs = Cart::where('uid',Session::get("id"))->where('gid',$request->input('gid'))->first();

    	if($rs){
    		$txgoods = \DB::table('goods')->find($rs->gid);
    		$num = $rs->num + 1;
    		if($num>=$txgoods->gtock+1){
    			return 9;
    		}
    		
    		Cart::where('id',$rs->id)->update(['num'=>$num]);
    		return 1;
    	}else{
    		Cart::create(['uid'=>Session::get("id"),'gid'=>$request->input('gid'),'num'=>1]);
    		return 2;
    	}
    }
    /**
     * 修改num
     * @return [type] [description]
     */
    function upnum(Request $request){
    	if($request->input('ac')!=null){
    		Cart::where('uid',Session::get('id'))->delete();
    		return 1;
    	}else{
    		Cart::where('id',$request->input('id'))->update(['num'=>$request->input('num')]);
    		return 1;
    	}
    	
    }
     /**
     * 删除单条
     * @return [type] [description]
     */
    function onedel(Request $request){
    	Cart::where('id',$request->input('id'))->delete();
    	return 1;
    }
     /**
     * 个人信息收货地址
     * @return [type] [description]
     */
    function mysite(Request $request){
    	$rs = Address::where('uid',Session::get('id'))->get();
    	return view('home.site',['rs'=>$rs]);
    	// 
    }
    function addsite(Request $request){
    	$rs=$request->except(['_token','id']);
    	if($request->input('id')){
    		if ($rs['moren']==1) {
    			$arr = Address::where('uid',Session::get('id'))->update(['moren'=>'0']);
    		}
	    	$arr = Address::where('id',$request->input('id'))->update($rs);
	    	$brr = Address::where('id',$request->input('id'))->first();
	    	return $brr;
    	}else{
    		if(!Session::get('id')){
    			return 0;
    		}
    		$rs['uid']=Session::get('id');
    		if ($rs['moren']==1) {
    			$arr = Address::where('uid',Session::get('id'))->update(['moren'=>'0']);
    		}
	    	$arr = Address::create($rs);
	    	return $arr;
    	}
    	
    }
    function delsite(Request $request){
    	Address::where('id',$request->input('id'))->delete();
    	return 1;
    }
}
