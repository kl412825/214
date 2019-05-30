<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="IE=7,8,9">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<meta name="keywords" content="会员登录,DBShop电子商务系统">
<meta name="description" content="会员登录,DBShop电子商务系统">
<link href="/ad/css/dbmall.css" rel="stylesheet">
<style type="text/css">
.site-header .header-info .search-form .search-text{
    width: 84%;
    height: 53%;
}
</style>
<link rel="shortcut icon" href="/img/tu.ico">

<script type="text/javascript">
if (/MSIE 6/.test(navigator.userAgent)) {
	window.location = '/DBShop/public/support-browser.html';
}
</script>
<!--[if lte IE 8]>
<script src="static/js/html5.js"></script>
<![endif]-->
<script src="/ad/js/frontjs.js"></script>
</head>
<body id="dbshop-body">
<!--顶部-->
<div class="site-topbar" id="site-topbar">
    <div class="container">
        <div class="topbar-nav">
                    </div>
             <div class="topbar-info J_userInfo">
            @if(session('id') != null )

            <ul class="list-inline">
                <li><a href="/home/user/login">欢迎您, &nbsp;{{session('uname')}}</a></li>
                <li><a href="/home/user/gun">退出</a></li>
                        <li><a href="/home/user/xx">用户中心</a></li>
                <li><a href="/home/user/dd">我的订单</a></li>
                <li><a href="/home/firend">友情申请</a></li>
                            
            </ul>
            @else
                <ul class="list-inline">
                	<li><a href="/home/firend">友情申请</a></li>
                            <li><a href="/home/user/login">用户中心</a></li>
                    <li><a href="/home/user/login">我的订单</a></li>
                                <li><a href="/home/user/login">登录</a></li>
                    <li><a href="/home/user/register">注册</a></li>
                </ul>

            @endif
        </div>
    </div>
</div>
<!--头部-->
<div class="site-header">
    <div class="container">
        <div class="site-logo"> <a href="/" class="logo"><img src="/ad/picture/logo.gif" style="height: 90px;"></a></div>
        <div class="header-info">
                        <div class="search-section">
                <form method="get" action="/su" class="search-form clearfix">
                    <input type="text" name="name" value="" placeholder="简简单单搜索" autocomplete="off" class="search-text">
                    <input type="submit" class="search-btn iconfont" value="">
                </form>
            </div>
            <div class="cart-section">
                @php
                 
                    $top =count(DB::table('cart')->where('uid',Session::get('id'))->get());
                    
                @endphp
                <a href="/user/cart" class="mini-cart" id="J_miniCart"><i class="iconfont"></i>购物车(<font id='gwc'>{{$top}}</font>)&nbsp;
                                                                    <span class="mini-cart-num J_cartNum" id="top_cart" style="display:none;">0</span>
                                    </a>
            </div>
        </div>
    </div>
    <div class="header_menu">
    <div class="container">
        <div class="header-nav clearfix">
            <div class="nav-category nav-category-toggled" id="J_categoryContainer">
    <a href="javascript:;" class="btn-category-list">商品分类<span id="goodsclass-b"><i class="iconfont"></i></span></a>

<style type="text/css">
    .nav-category-section{
        display: none;
    }
</style>

    <div class="nav-category-section" id="j_nav-category-section" ">

          <ul class="nav-category-list">
     @php
     use App\Http\Controllers\Admin\TypeController;
        $res = TypeController::getfenleiMessage(0);
       
     @endphp
        @foreach($res as $v)
        <li class="nav-category-item">
            <div class="nav-category-content">
              @if($v->status ==1)
                <a href="" class="title">
                {{$v->tname}}
                </a>
                @endif
                <div class="links">
                     @foreach($v->sub as $v1)
                         @if($v1->status ==1)
                        <a href="/goods/{{$v1->id}}">
                           {{$v1->tname}}

                        </a>
                        @endif
                     @endforeach
               
                </div>
                
             
            </div>
        </li>
        
        @endforeach
    </ul>
    </div>
</div>

<script>
    @php
     $a = Request::getRequestUri();
    @endphp
    @if($a !='/')


        $('#J_categoryContainer').mouseover(function(){
            $('#j_nav-category-section').css('display', 'block');
            $('#goodsclass-b').html('<i class="iconfont"></i>');
        });
        $("#J_categoryContainer").mouseout(function(){
            $('#j_nav-category-section').css('display', 'none');
            $('#goodsclass-b').html('<i class="iconfont"></i>');
        });
    @endif
</script>
<div class="nav-main">
    <ul class="nav-main-list J_menuNavMain clearfix">
        @php
         use App\Model\Admin\type;
         $a = type::where('path','!=','0,')->paginate(10);
        
       
     @endphp
     <li class="nav-main-item">
           
            <a href="/"><span class="text">首页</span></a>
           
        </li>
      @foreach($a as $v)
        <li class="nav-main-item">
           
            <a href="/goods/{{$v->id}}"><span class="text">{{$v->tname}}</span></a>
           
        </li>
         @endforeach
            </ul>
</div>        </div>
    </div>
</div>
</div>

@section('content')

@show

<div class="site-footer">
            <div class="footer-service">
        <div class="container">
            <ul class="list-service clearfix">
                                    <li class="li_service">
                        <a target="_blank" href="/DBShop/article/single/id/16">
                            <i class="iconfont"></i>                            <strong>一小时快速响应</strong>
                        </a>
                    </li>
                                    <li class="li_service">
                        <a target="_blank" href="/DBShop/article/single/id/17">
                            <i class="iconfont"></i>                            <strong>7天无理由退货</strong>
                        </a>
                    </li>
                                    <li class="li_service">
                        <a target="_blank" href="/DBShop/article/single/id/18">
                            <i class="iconfont"></i>                            <strong>15天免费换货</strong>
                        </a>
                    </li>
                                    <li class="li_service">
                        <a target="_blank" href="/DBShop/article/single/id/19">
                            <i class="iconfont"></i>                            <strong>满100包邮</strong>
                        </a>
                    </li>
                                    <li class="li_service">
                        <a target="_blank" href="/DBShop/article/single/id/20">
                            <i class="iconfont"></i>                            <strong>售后服务</strong>
                        </a>
                    </li>
                            </ul>
        </div>
        </div>
        <div class="container">
        <div class="footer-links clearfix">
            <dl class="col-links col-links-first">
                <dt>帮助中心</dt>
                                <dd>
                    <a target="_blank" href="/DBShop/article/single/id/13">
                        如何购买                    </a>
                </dd>
                                <dd>
                    <a target="_blank" href="/DBShop/article/single/id/14">
                        如何收货                    </a>
                </dd>
                            </dl>
            <dl class="col-links">
                <dt>服务支持</dt>
                                        <dd>
                            <a target="_blank" href="/DBShop/article/single/id/5">
                                联系我们                            </a>
                        </dd>
                                            <dd>
                            <a target="_blank" href="/DBShop/article/single/id/6">
                                退换服务                            </a>
                        </dd>
                                </dl>
            <dl class="col-links">
                <dt>支付方式</dt>
                                        <dd>
                            <a target="_blank" href="/DBShop/article/single/id/7">
                                在线支付                            </a>
                        </dd>
                                            <dd>
                            <a target="_blank" href="/DBShop/article/single/id/8">
                                线下支付                            </a>
                        </dd>
                                </dl>
            <dl class="col-links">
                <dt>关于我们</dt>
                                        <dd>
                            <a target="_blank" href="/DBShop/article/single/id/9">
                                关于我们                            </a>
                        </dd>
                                            <dd>
                            <a target="_blank" href="/DBShop/article/single/id/10">
                                网站介绍                            </a>
                        </dd>
                                </dl>
            <dl class="col-links">
                <dt>客服中心</dt>
                                        <dd>
                            <a target="_blank" href="/DBShop/article/single/id/11">
                                联系客服                            </a>
                        </dd>
                                            <dd>
                            <a target="_blank" href="/DBShop/article/single/id/12">
                                服务说明                            </a>
                        </dd>
                                </dl>
            <div class="col-contact">
                <p><span style="font-size: 20px;"><strong>400-800-xxxx</strong></span></p><p>周一至周五 9:00-18:00<br/></p>            </div>
        </div>
        <div>
            @php
                $res = DB::table('firend')->where('status',1)->get();               
            @endphp
            @foreach($res as $k => $v)
            <li style="float:left;margin-left:30px"><a href="{{$v->furl}}" style="color:white">{{$v->fname}}</a></li>
            @endforeach

        </div>
        <div class="footer-info clearfix">
                        <div style="position:relative;" class="info-text">

<p>Copyright &copy;2012-2019  <a href="https://www.dbshop.net/" target="_blank">DBShop</a> 版权所有<br /></p>

<p align="center">
    </p>

</div>
</div>
</div>
</div>

<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <h3>DBShop电子商务系统 提示</h3>
  </div>
  <div class="modal-body">
    <p id="message_show"></p>
  </div>
  <div class="modal-footer" id="message_url">
  </div>
</div>


<style type="text/css">
    .go-top{position:fixed;width:40px;bottom:15%;right:0;z-index:890;}
    .go-top .go-top-box{width:100%;margin-bottom:3px;background:#d9d9d9;text-align:center;}
    .go-top .go-top-box a{display:block;height:35px;padding-top:5px;}
    .go-top .go-top-box a:hover{background:#777777;text-decoration:none;}
    .go-top .go-top-box a:hover .asid_title,.go-top .go-top-box .asid_title{color:#fff;font-size:12px;display:block;padding-left:6px;line-height:18px;width:30px;margin-top:-2px;}
</style>
<div class="go-top" id="go-top">
    <div class="go-top-box relative" style="display:none;">
        <a href="#"><img alt="返回顶部" title="返回顶部" class="adid_icon" src="/ad/picture/icon_back.png"></a>
    </div>
</div>
<script>
    (function(e){e.fn.hhShare=function(t){var n={cenBox:"go-top-box",icon:"adid_icon",addClass:"red_bag",titleClass:"asid_title",triangle:"asid_share_triangle",showBox:"asid_sha_layer"},r=e.extend(n,t);this.each(function(){var t=e(this),n=e("."+r.cenBox).last();n.hide(),e("."+r.triangle+","+"."+r.showBox).hide(),e("."+r.cenBox).live({mouseenter:function(){var t=e(this).find("."+r.icon),n=e(this).find("."+r.icon).attr("alt");t.hide(),e(this).addClass(r.addClass),e(this).children("a").append('<b class="'+r.titleClass+'">'+n+"</b>"),e(this).find("."+r.triangle+","+"."+r.showBox).show()},mouseleave:function(){var t=e(this).find("."+r.icon),n=e(this).find("."+r.icon).attr("alt");t.show(),e(this).removeClass(r.addClass),e(this).find("."+r.titleClass).remove(),e(this).find("."+r.triangle+","+"."+r.showBox).hide()}}),e(window).scroll(function(){e(window).scrollTop()>100?n.fadeIn():n.fadeOut()}),n.click(function(){return e("body,html").animate({scrollTop:0},500),!1})})}})(jQuery);
    $(function(){
        $('#go-top').hhShare({
            icon       : 'adid_icon'
        });
    });
</script>
</body>
</html>

  @section('js')
   
@show