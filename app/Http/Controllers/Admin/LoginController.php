<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder; 
use Session;
use DB;
use Hash;
class LoginController extends Controller
{
    //登录页面
    public function login()
    {
    	return view('admin.login',['title' => '后台登录']);
    }

    //处理登录的信息
    public function dologin(Request $request)
    {
    	//dump($request->all());
    	//表单验证
    	//获取用户名
    	$um = $request->uname;

    	//根据用户名作对比
    	$rs = DB::table('adminuser')->where('username',$um)->first();


    	if(!$rs){

            return back()->with('error','用户名或密码错误');
        }
        
        
        //对比密码
        $pass = $rs->password;
        if(!Hash::check($request->password,$pass)){
            return back()->with('error','用户名或密码错误');
        }

        //验证码
        $code = session('code');

        if($code != $request->code){
            return back()->with('error','验证码错误');
        }
        if($rs->ustatus == 0){
    		return back()->with('error','用户名已禁用，请与管理员联系');
    	}
        //存储用户信息
        session(['uid'=>$rs->id]);

        return redirect('/admins')->with('success','登录成功');

    }

    //验证码
    public function  captcha()
    {
    	$phrase = new PhraseBuilder;
        //设置验证码位数
        $code = $phrase->build(4);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        //设置背景颜色
        $builder->setBackgroundColor(40, 144, 250,0.2);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['code'=> $phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    	
    }

    //显示修改头像
    public function profile(Request $request)
    {
        $rs = DB::table('adminuser')->where('id',session('uid'))->first();

        return view('admin.profile',['title' => '修改头像','rs' => $rs]);
    }
 
    //处理头像
    public function upload(Request $request)
    {
            $file = $request->file('file_upload');


            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

            echo '/uploads/'.$name.'.'.$suffix;

            //修改数据表里面的信息
            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

            DB::table('adminuser')->where('id',session('uid'))->update($rs);
        
    }


    //修改密码页面
    public function pass()
    {
        return view('admin.pass',['title' =>'修改密码']);
    }


    //处理修改密码
    public function dopass(Request $request)
    {
    	//验证信息
    	$this->validate($request, [     
        'password' => 'required|regex:/^[a-zA-Z]\w{5,17}$/',
        'repass' => 'required|same:password'       
    ],
    [   
        'password.required' => '密码不能为空',
        'password.regex' => '密码格式不正确',
        'repass.required' => '确认密码不能为空',
        'repass.same' => '两次密码不一致'
        
    ]);
    	//获取旧密码
    	$pass = $request->oldpass;

    	//获取当前用户的信息
    	$rs = DB::table('adminuser')->where('id',session('uid'))->first();
    	//检测
    	if(!Hash::check($pass,$rs->password)){
    		return back()->with('error','旧密码有误');
    	}
    	
    	$res['password'] = Hash::make($request->password);
    	$data = DB::table('adminuser')->where('id',session('uid'))->update($res);

    	if($data){
    		return redirect('/admin/login');

    	}else{
    		return back();
    	}
    }
 
    //退出
    public function logout()
    {

        //清楚session
        session(['uid'=>'']);

        //重定向
        return redirect('/admin/login')->with('success','退出成功');
    }
} 
