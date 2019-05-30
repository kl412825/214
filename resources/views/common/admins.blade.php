
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/admin/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/custom-plugins/wizard/wizard.css" media="screen">

<link rel="shortcut icon" href="/img/ht.ico">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admin/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/themer.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/style.css" media="screen">
<title>@yield('title')</title>
</head>
<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<!-- <img src="/admin/images/mws-logo.png" alt="mws admin"> -->

                <h3 style='color:white;'>易星商城</h3>
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
            @php
                $us = DB::table('adminuser')->where('id',session('uid'))->first();
          
            @endphp
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	<img src="{{$us->profile}}" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {{$us->username}}
                    </div>
                    <ul>
                    	<li><a href="/admin/profile">修改头像</a></li>
                        <li><a href="/admin/pass">修改密码</a></li>
                        <li><a href="/admin/logout">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
                <div id="mws-sidebar-stitch"></div>
                <div id="mws-sidebar-bg"></div>
                
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                	<li>
                        <a href=""><i class="icon-user"></i>管理员管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/users/create">添加管理员</a></li>
                            <li><a href="/admin/users">浏览管理员</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href=""><i class="icon-add-contact"></i>用户管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/user/create">添加用户</a></li>
                            <li><a href="/admin/user">浏览用户</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="icon-users"></i>角色管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/role/create">添加角色</a></li>
                            <li><a href="/admin/role">浏览角色</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href=""><i class="icon-key-2"></i>权限管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/permission/create">添加权限</a></li>
                            <li><a href="/admin/permission">浏览权限</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i>商品类别管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/type/create">添加类别</a></li>
                            <li><a href="/admin/type">浏览类别</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-briefcase"></i>商品管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/good/create">添加商品</a></li>
                            <li><a href="/admin/good">浏览商品</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i>订单管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/Dd">所有列表</a></li>
                            <li><a href="/admin/Dd?od=j">今日订单</a></li>
                            <!-- <li><a href="/admin/gogo">55</a></li> -->
                            <li><a href="/admin/gogo">订单统计</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href=""><i class="icon-link"></i>友情管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/firend/create">添加友情</a></li>
                            <li><a href="/admin/firend">浏览友情</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-arrow-right-2"></i>轮播图管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/show/create">添加轮播图</a></li>
                            <li><a href="/admin/show">浏览轮播图</a></li>
                        </ul>
                    </li>  
                    <li>
                        <a href="#"><i class="icon-arrow-right-2"></i>评论管理</a>
                        <ul class='closed'>
                            
                            <li><a href="/admin/pl">浏览评论</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-arrow-right-2"></i>首页推荐</a>
                        <ul class='closed'>
                            
                            <li><a href="/home/management">商品推荐管理</a></li>
                        </ul>
                    </li>
               
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            @section('content')


            @show             
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/admin/js/libs/jquery-3.2.1.min.js"></script>
    <script src="/admin/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/admin/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/admin/jui/jquery-ui.custom.min.js"></script>
    <script src="/admin/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admin/plugins/flot/jquery.flot.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/admin/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/admin/plugins/validate/jquery.validate-min.js"></script>
    <script src="/admin/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/admin/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/admin/js/demo/demo.dashboard.js"></script>

</body>
</html>

@section('js')


@show