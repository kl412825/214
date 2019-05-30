<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin\Users;

class RoleperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	//获取用户管理员的信息
    	$users = Users::find(session('uid'));
    	
    	//根据用户管理员的信息查找响应的角色
    	$roles = $users->users_role()->get(); 

    	$prs = [];
    	foreach($roles as $k => $v){
    		$pers = $v->role_per()->get();
    			foreach($pers as $k=>$peru){
    					$prs[] = $peru->perurl;
    			} 		
    	}

    	$psr = array_unique($prs);
    	//获取点击功能的url地址
    	$urls = \Route::current()->getActionName();

    	//判断
    	if(in_array($urls,$psr)){
    		return $next($request);
    	}else{
    		return redirect('/admin/per');
    	}
    	


        return $next($request);
    }
}
