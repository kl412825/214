<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\YonghuRequest;
use App\Model\Admin\Users;
use App\Model\Admin\Role;
use Hash;
use DB;

class UsersController extends Controller
{

	
	//给用户添加角色页面
	public function users_role(Request $request)
	{	
		//把用户的信息显示出来
		//获取管理员id
		$uid = $request->id;
		
		

		//获取角色的id 
		$us = Users::find($uid);

		//获取所有的角色
		$roles = Role::all();

		$ur = $us->users_role()->get();
		

		$urr = [];
		foreach($ur as $k => $v){
			$urr[] = $v->id;
		}
		
		return view('admin.users.usersrole',['title'=>'添加角色','us'=>$us,'roles' =>$roles,'urr'=>$urr]);
	}



	//处理用户和角色的方法
	public function do_users_role(Request $request)
	{	
		//获取用户的id
		$uid = $request->id;

		DB::table('users_role')->where('usersid',$uid)->delete();

		//获取角色的id
		$rid = $request->roleid;
		
		$ur = [];

		foreach($rid as $k =>$v){
			$arr = [];
			$arr['usersid'] = $uid;
			$arr['roleid'] = $v;

			$ur[] = $arr;


		}
		//往数据表users_role里添加数据
		$data = DB::table('users_role')->insert($ur);

		if($data){
			return redirect('/admin/users')->with('success','添加角色成功');
		}else{
			return back()->with('error','添加角色失败');
		}

	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //多条件搜索
    	$rs = Users::orderBy('id','asc')

            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('username');
                $email = $request->input('email');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 10));

        return view('admin.users.list',['title'=>'管理员列表','request' => $request,'rs' => $rs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create',['title'=>'管理员添加页面']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YonghuRequest $request)
    {
        //

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
        $rs['addtime'] = time();
        
        

        //存放数据库里面
        $data = Users::create($rs);

        if($data){

            return redirect('admin/users');

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
        $rs = Users::find($id);
        return view('admin.users.edit',['title'=>'管理员修改','rs'=>$rs]);
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
        'email.unique' => '该邮箱也被注册',
        'phone.required' => '手机号不能为空',
        'phone.regex' => '手机号格式不正确',  
             
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
        $rs['addtime'] = time();       

        try{
           
              
       		 $data = Users::where('id',$id)->update($rs);

        if($data){

                return redirect('/admin/users')->with('success','修改成功');
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
        //
        //根据id获取数据
        //unlink() 返回boolean类型
        $data = Users::destroy($id);
        if($data){
        	return redirect('/admin/users')->with('success','删除成功');

        }else{
        	return back()->with('error','删除失败');
        }    
    }

    //修改状态
    public function zhuangtai(Request $request)
    {	
    	
    	$id = $request->id;
    	$rs = Users::find($id);  

    	if($rs->ustatus == 0)
    	{
    		$res['ustatus'] = 1;
    	}else{
    		$res['ustatus'] = 0; 
    	}
		
    	$data = Users::where('id',$id)->update($res);

        if($data){
        	return redirect('/admin/users')->with('success','修改成功');
        }else{
        	return back()->with('error','修改失败');
        }  	
    }
}
