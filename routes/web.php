<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//后台登录
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/dologin','Admin\LoginController@dologin');
Route::get('/admin/captcha','Admin\LoginController@captcha');

Route::get('/admin/per','Admin\RoleController@rpes');
//
//后台
//权限中间件,'roleper'

Route::group(['middleware' => 'login'], function(){
	//后台的首页
	Route::get('admins','Admin\IndexController@index');

	//后台的管理员添加权限页面
	Route::get('/admin/usersrole','Admin\UsersController@users_role');

	//后台的管理员添加权限
	Route::post('/admin/dousersrole','Admin\UsersController@do_users_role');

	//后台的管理员
	Route::resource('/admin/user','Admin\UserController');

	//用户管理
	Route::resource('/admin/users','Admin\UsersController');

	//修改头像
	Route::get('admin/profile','Admin\LoginController@profile');
	Route::post('admin/upload','Admin\LoginController@upload');

	//修改密码
	Route::get('admin/pass','Admin\Logincontroller@pass');
	Route::post('admin/dopass','Admin\Logincontroller@dopass');

	//退出
	Route::get('admin/logout','Admin\LoginController@logout');

	//用户修改状态
	Route::get('admin/ustatus','Admin\UserController@ustatus');

	//管理员修改状态
	Route::get('admin/zhuangtai','Admin\UsersController@zhuangtai');

	//角色管理
	Route::resource('/admin/role','Admin\RoleController');
	Route::get('/admin/roleper','Admin\RoleController@role_per');
	Route::post('/admin/doroleper','Admin\RoleController@doroleper');
	
	//权限管理
	Route::resource('/admin/permission','Admin\PermissionController');

	//友情链接
	Route::resource('/admin/firend','Admin\FirendController');

	//后台商品分类
	Route::resource('/admin/type','Admin\TypeController');
	//分类添加子类
	Route::get('admin/ty/{id}','Admin\TypeController@ty');
	
	//商品管理
	Route::resource('/admin/good','Admin\GoodsController');
	//修改状态
	Route::get('/admin/goods/{id}','Admin\GoodsController@sta');
	//商品详情
	Route::get('/admin/xq/{id}','Admin\GoodsController@xq');
	//获取无限极分类的递归
	// Route::get('/dam','Admin\TypeController@demo');
	//轮播图
	Route::resource('/admin/show','Admin\SlideshowController');
	
	//评论管理
	Route::resource('/admin/pl','Admin\PlController');
	//订单管理
	Route::resource('/admin/Dd','Admin\DdController');
	//订单删除
	Route::post('/admin/del','Admin\DdController@del');
	//订单修改
	Route::post('/admin/up','Admin\DdController@up');
	//发货统计
	Route::get('/admin/gogo','Admin\DdController@gogo');
	

});


//前台首页
Route::get('/', 'Home\IndexController@index');
//商品页
Route::get('/goods/{id}', 'Home\IndexController@goods');
//商品详情
Route::get('/goods/gxq/{id}', 'Home\IndexController@gxq');
//搜素
Route::get('/su', 'Home\SuController@su');
//友情申请
Route::get('/home/firend','Home\FirendController@index');
Route::post('/home/tianjia','Home\FirendController@tianjia');

//前台
Route::group([], function(){
	
		//商品品评论
	Route::get('/pl', 'Home\SuController@pl');
	//商品回复评论
	Route::get('/hf', 'Home\SuController@hf');
	
});


































//前台登录
Route::get('/home/user/login', 'Home\IndexController@login');
//前台注册页面
Route::get('/home/user/register', 'Home\IndexController@register');
//注册是否成功的跳转页面
Route::get('/home/user/isgo', 'Home\IndexController@isgo');
//ajax查询账号或者手机是否存在
Route::post('/home/user/uname', 'Home\IndexController@uname');
//ajax 发送验证码
Route::post('/home/user/jhyzm', 'Home\IndexController@jhyzm');
//前台注册处理
Route::post('/home/user/re', 'Home\IndexController@re');
//前台登录处理
Route::post('/home/user/login/lo', 'Home\IndexController@lo');
//前台退出
Route::get('/home/user/gun', 'Home\IndexController@gun');
//前台手机找回密码页面
Route::get('/home/user/forgotpasswd', 'Home\IndexController@forgotpasswd');
//手机修改密码
Route::post('/home/user/forgotpasswd/update', 'Home\IndexController@forgotpasswdupdate');
//前台邮箱找回密码页面
Route::get('/home/user/phoneforgotpasswd', 'Home\IndexController@phoneforgotpasswd');
//前台邮箱修改密码
Route::post('/home/user/phoneforgotpasswd/update', 'Home\IndexController@phoneforgotpasswdupdate');
//ajax邮箱发送
Route::post('/home/user/stmp163', 'Home\IndexController@stmp163');

//ajax查询所有订单
Route::post('/home/user/cdd', 'Admin\DdController@cdd');
//首页推荐
Route::resource('/home/management', 'Home\ManagementController');
//首页推荐删除
Route::post('/admin/management/del', 'Home\ManagementController@dele');
//首页推荐商品查询
Route::post('/admin/management/select', 'Home\ManagementController@select');
//首页添加
Route::post('/admin/management/add', 'Home\ManagementController@add');
//用户中心
Route::get('/home/user/xx', 'Home\InfoController@xx');
//订单
Route::get('/home/user/dd', 'Home\InfoController@dd');
//基本信息
Route::get('/home/user/info', 'Home\InfoController@info');
//我的收藏
Route::get('/home/user/balance', 'Home\InfoController@balance');
//基本信息修改
Route::post('/home/userinfo/update', 'Home\InfoController@infoupdate');
//查询我的收藏
Route::get('/home/user/select/balance', 'Home\InfoController@selectbalance');
//删除个人收藏
Route::post('/home/user/del/balance', 'Home\InfoController@delbalance');
//购物车
Route::get('/user/cart', 'Home\InfoController@cart');
//加入购物车
Route::get('/user/addcart', 'Home\InfoController@addcart');
//修改购物车num
Route::post('/user/addcart/upnum', 'Home\InfoController@upnum');
//删除购物车单条数据
Route::post('/user/addcart/del', 'Home\InfoController@onedel');
//收货地址
Route::get('/user/site', 'Home\InfoController@mysite');
//收货地址添加
Route::get('/user/addsite', 'Home\InfoController@addsite');
Route::post('/user/delsite', 'Home\InfoController@delsite');
