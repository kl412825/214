<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Http\Requests\HomeRequest;
use Hash;

class UserController extends Controller
{ 
	
	


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	//获取传过来的信息
    	/*$um = $_GET['num'];
    	$se = $_GET['search'];
    	dump($um,$se);*/


    	//$um = $request->num;
    	//$search = $request->search;

    	//获取数据 
    	//但条件搜索
    	//$rs = User::where('uname','like','%'.$search.'%')->paginate($request->input('num',10));
    	
    	//多条件搜索
    	$rs = User::orderBy('id','asc')

            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('username');
                $email = $request->input('email');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('uname','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 10));

    	
    	
        //显示列表页面
        return view('admin.user.list',['title' => '用户列表页面','rs' => $rs,'request'=>$request]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create',['title'=>'用户添加页面']);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeRequest $request)
    {
        /*$this->validate($request,[
            'uname' => 'required|regex:/^[a-zA-Z][A-Za-z0-9_]{5,11}$/|unique:user',
            'password' => 'required|regex:/^[a-zA-Z]\w{5,17}$/',
            'repass' => 'required|same:password',
            'email' => 'required|email|unique:user',
            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:user',
            
            'age' => 'required|regex:/^\d{3}$/'
        ],[
            'uname.required' => '用户不能为空',
        'uname.regex'  => '用户名格式不正确',
        'uname.unique'  => '用户名已存在',
        'password.required' => '密码不能为空',
        'password.regex' => '密码格式不正确',
        'repass.required' => '确认密码不能为空',
        'repass.same' => '两次密码不一致',
        'email.required' => '邮箱不能为空',
        'email.email' => '邮箱个是不正确',
        'email.unique' => '该邮箱已被注册',
        'phone.required' => '手机号不能为空',
        'phone.regex' => '手机号格式不正确',
        'phone.unique' => '该手机号已被注册',
        'age.regex' => '年龄格式不正确'

        ]);*/

    	//获取表单传过来的值
        $rs = $request->except('_token','repass','profile');


        //处理图片上传
        if($request->hasFile('profile')){

            //获取图片上传的信息
            $file = $request->file('profile');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

        }

        //密码的加密
        $rs['password'] = Hash::make($request->password);
        $rs['uaddtime'] = time();
        
        //存放数据库里面
        $data = User::create($rs);

        if($data){

            return redirect('admin/user');

        } else {

            return back();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //根据id获取数据
        $rs = User::find($id);
        //显示页面
        
        return view('admin.user.edit',['title' => '用户的修改页面','rs'=>$rs]);
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
        'email' => 'required|email',
        'phone' => 'required|regex:/^1[34578]\d{9}$/'
    ],
    [
       
        'email.required' => '邮箱不能为空',
        'email.email' => '邮箱个是不正确',       
        'phone.required' => '手机号不能为空',
        'phone.regex' => '手机号格式不正确' 
            
    ]);

         //获取所有数据
        $rs = $request->except('_token','_method');
        //删除头像
        //dd($rs);
        //unlink('.'.$rs['profile']);
        //处理图片上传
        if($request->hasFile('profile')){
            //获取图片上传的信息
            $file = $request->file('profile');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;
        }
        $rs['uaddtime'] = time();
       	

        
         try{
           
              
       		 $data = User::where('id',$id)->update($rs);

            if($data){

                return redirect('/admin/user')->with('success','修改成功');
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
        //根据id获取数据
        //unlink() 返回boolean类型
        $data = User::destroy($id);
        if($data){
        	return redirect('/admin/user')->with('success','删除成功');

        }else{
        	return back()->with('error','删除失败');
        }      
    }


    //修改状态
    public function ustatus(Request $request)
    {	
    	
    	$id = $request->id;
    	$rs = User::find($id);   	   	
    	if($rs->ustatus == 0)
    	{
    		$rs->ustatus = 1;
    	}else{
    		$rs->ustatus = 0; 
    	}
		
    	$data = User::where('id',$id)->update(['ustatus'=>$rs->ustatus]);

        if($data){
        	return redirect('/admin/user')->with('success','修改成功');
        }else{
        	return back()->with('error','修改失败');
        }
        
    	
    	
    	
    }
}
