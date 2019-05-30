<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	/**
	 * 后台首页
	 * @return [type] [description]
	 */
    public function index(Request $request)
    {
    	//ip
    	$arr['ip']=($request->ip());
    	//操作系统
    	$arr['os']=PHP_OS;
    	//运行环境
    	$arr['environment']=$_SERVER["SERVER_SOFTWARE"];
    	//php版本
    	$arr['versions']=PHP_VERSION;
    	//运行模式
    	$arr['operation']=php_sapi_name();
    	//表单上传最大值
    	$arr['formmax']=ini_get('post_max_size');
    	//服务器允许最
    	$arr['servermax']=ini_get('upload_max_filesize');
    	//laravel版本
    	$laravel = app();
    	$arr['laravelver']=$laravel::VERSION;
    	return view('admin.index',['arr'=>$arr]);
    }

}
