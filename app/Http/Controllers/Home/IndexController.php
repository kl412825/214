<?php

namespace App\Http\Controllers\Home;
use App\Model\Admin\type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\slideshow;
use  App\Model\Admin\Goods;
use App\Model\Admin\img;

use Illuminate\Support\Facades\Hash;
use DB;
use Mail;
class IndexController extends Controller
{
    public function index()
    {
    	$rs = type::all();
    	$sh = slideshow::all();

    	return view('home.index',['sh'=>$sh,'title'=>'首页']);
    }

    /**
     * 商品页
     */
    public function goods($id)
    { 

        if(empty($_GET['id'])){
            $_GET['id']='s';
        }
        if($_GET['id'] =='s'){
            $rs = Goods::where('tid',$id)->orderBy('gprice', 'desc')->get(); 
        }else if($_GET['id'] =='a'){
             $rs = Goods::where('tid',$id)->orderBy('gprice', 'asc')->get(); 
        }
    	$ty = type::find($id);
    	$t =type::find($ty->pid);
    	
       
    	$s = Goods::where('tid',$id)->count();
        
    		return view('home.goods',['title'=>'商品页','ty'=>$ty->tname,'rs'=>$rs,'tt'=>$t->tname,'s'=>$s,'id'=>$id]);
    }
    /**
     * 商品详情页
     */
    public function gxq($id)
    {

        
        $rs = Goods::where('id',$id)->first();
        $ty = type::where('id',$rs->tid)->first();
        $t =type::find($ty->pid);

        $tp = img::where('gid',$rs->id)->get();
        return view('home.xq',['title'=>'详情','rs'=>$rs,'tp'=>$tp,'ty'=>$ty,'ts'=>$t]);
    }

     /**
     * 前台登录
     */
    public function login(Request $request){
        if(\Session::get('id')!=null){
            \Session::flush();
        }
        $send=session()->get('xxoo');
        return view('home.login',['send'=>$send]);
    }
    /**
     * 注册页面
     * @return [type] [description]
     */
    public function register(){
        return view('home./register');
    }
    public function re(Request $request){
        $rs = $request->only(['uname','password','phone']);
        $rs['uaddtime']=time();
        if(!preg_match('/^[a-zA-Z][A-Za-z0-9_]{5,11}$/', $rs['uname'])){return redirect('/home/user/register');}
        if(!preg_match('/[A-Za-z0-9]{6,18}/', $rs['password'])){return redirect('/home/user/register');}
        if(!preg_match('/^1(3|4|5|7|8)\d{9}$/', $rs['phone'])){return redirect('/home/user/register');}
        $rs['password']=Hash::make($request->password);
        $arr = DB::table('user')->insert($rs);
        if($arr){
            
            return redirect('/home/user/isgo?ac=yes');
        }else
        {
            return redirect('/home/user/isgo?ac=no');
        }
        
    }
    /**
     * [isgo description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public  function isgo(Request $request){
        $rs = $request->input('ac');
        $uname = $request->input('uname');
        return view('home./isgo',['rs'=>$rs ,'un'=>$uname]);
    }
    /**
     * 查询手机账号是否重复的方法
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public  function uname(Request $request){
        if($request->input('phone') != null){
            //进入手机判断模式
            $rs = $request->input('phone');
            $arr = DB::table('user')->where('phone',$rs)->first();
            if($arr == null){
                return 0;
            }else{
                return 1;
            }
        }else if( $request->input('email') != null ){
            //进入邮箱判断模式
            $rs = $request->input('email');
            $arr = DB::table('user')->where('email',$rs)->first();
            if($arr == null){
                return 0;
            }else{
                return 1;
            }
        }else{
            //进入账号判断模式
            $rs = $request->input('uname');
            $arr = DB::table('user')->where('uname',$rs)->first();
            if($arr == null){
                return 0;
            }else{
                return 1;
            }
        }
        
    }
    /**
     * 
     */
    public function jhyzm(Request $request){

            $sj = $request->input('phone');
            $yzm = $request->input('yzm');
            $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
            $smsConf = array('key' =>'87258237e078ab29bd4413a5994ac20b', //您申请的APPKEY
            'mobile' =>"$sj", //接受短信的用户手机号码
            'tpl_id' =>'152859', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>"#code#=$yzm&#company#=聚合数据" //您设置的模板变量，根据实际情况修改
            );

            $content = juhecurl($sendUrl, $smsConf, 1); //请求发送短信
            if ($content) {
                $result = json_decode($content, true);
                $error_code = $result['error_code'];
                if ($error_code == 0) {
                    //状态为0，说明短信发送成功
                    echo "1";
                } else {
                    //状态非0，说明失败
                    $msg = $result['reason'];
                    echo "0";
                }
            } else {
                //返回内容异常，以下可根据业务逻辑自行修改
                echo "请求发送短信失败";
            }

            /**
             * 请求接口返回内容
             * @param  string $url [请求的URL地址]
             * @param  string $params [请求的参数]
             * @param  int $ipost [是否采用POST形式]
             * @return  string
             */
            
    }
    /**
     * 登录过程 
     */
    public function lo(Request $request){
        $rs = $request->input();
        $arr = DB::table('user')->where('uname',$rs['uname'])->first();
        if($arr != null){
            if($arr->ustatus==0){
                session()->flash('xxoo', 'status');
                return redirect('/home/user/login');
            }
            if(Hash::check($rs['password'], $arr->password)){
                session(['id'=>$arr->id,'uname'=>$arr->uname,'uauth'=>$arr->uauth]);
                return redirect('/');
            }else{
                session()->flash('xxoo', '0');
                return redirect('/home/user/login');
            }
        }else{
                session()->flash('xxoo', '0');
                return redirect('/home/user/login');
        }
    }
    /**
     * 前台退出
     */
    public function gun(){
        \Session::flush();
        return redirect('/');
    }
    /**
     * 找回密手机
     * @return [type] [description]
     */
    public function forgotpasswd(){
        return view('home.forgotpasswd');
    }
    /**
     * 手机找回密码处理
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function forgotpasswdupdate(Request $request ){

        $phone = $request->input('phone');
        $pwd['password'] = $request->input('password');
        if(!preg_match('/[A-Za-z0-9]{6,18}/', $pwd['password'])){return redirect('/home/user/register');}
        $pwd['password']=Hash::make($request->password);
        $brr = DB::table('user')->where('phone',$phone)->first();
        $arr = DB::table('user')->where('phone',$phone)->update($pwd);
        if($arr){           
            return redirect('/home/user/isgo?ac=sj&uname='.$brr->uname);
        }else{
            return redirect('/home/user/isgo?ac=nosj');
        }
    }
    /**
     * 电子邮箱找回密码处理
     * @return [type] [description]
     */
    public function phoneforgotpasswdupdate(Request $request){
        $email = $request->input('email');
        $pwd['password'] = $request->input('password');
        if(!preg_match('/[A-Za-z0-9]{6,18}/', $pwd['password'])){return redirect('/home/user/register');}       
        $pwd['password']=Hash::make($request->password);
        $brr = DB::table('user')->where('email',$email)->first();
        $arr = DB::table('user')->where('email',$email)->update($pwd);
        if($arr){           
            return redirect('/home/user/isgo?ac=sj&uname='.$brr->uname);
        }else{
            return redirect('/home/user/isgo?ac=nosj');
        }
    }
    
    /**
     * 找回密邮箱
     * @return [type] [description]
     */
    public function phoneforgotpasswd(){
        return view('home.phoneforgotpasswd');
    }
    public function stmp163(Request $request){
        $rs = $request->input('email');
        $rand = $request->input('yzm');
        $arr = DB::table('user')->where('email',$rs)->first();
        $arr->rand=$rand;
        //显示信息          
        Mail::send('home.email',['arr'=>$arr], function ($m) use($arr) {
            
            $m->from(env('MAIL_USERNAME'), '易星商场');

            $m->to($arr->email,$arr->uname)->subject('易星商场找回密码!!');
        });
            echo "1";
    }
}
