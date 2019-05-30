@extends('common/public')
@section('title', '易星商场个人信息')
@section('content')
<div class="container breadcrumbs">
       <link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
    <a href="/">首页</a>
    <span class="sep">/</span><span id ='name'>@yield('name')</span>
</div>
	<div class="container">
<div class="uc-full-box">
    <div class="row">
        <div class="span4">
            <div class="uc-nav-box">
    <div class="box-hd">
        <h3 class="title">用户中心</h3>
    </div>
    <div class="box-bd">
        <ul class="uc-nav-list">
            <li ><a class='oop' href="/home">中心首页</a></li>
            <li ><a class='oop' href="/home/order">我的订单</a></li>            
            <li><a class='oop' href="/home/user/balance">我的收藏</a></li>
            <li><a class='oop' href="/home/money">账户余额</a></li>
            <li><a class='oop' href="/home/user/info">账户信息</a></li>
            <li><a class='oop' href="/user/site">收货地址</a></li>            
            <li><a class='oop' href="/home/refund">退货申请</a></li>
            <li><a class='oop' href="/home/user/gun">用户退出</a></li>
        </ul>
    </div>
</div>        </div>
        <!-- .span4 END -->

        <div class="span16">
            @section('gai')

			@show
            <div class="uc-box">
            <div class="uc-order-list-box">
            <ul class="uc-order-detail-list">
             </ul>
            </div>
            </div>
        </div>
    </div>

</div>
<!-- .uc-full-box END -->


</div>
<script type="text/javascript">
    // class="current"
    var arr = $('.oop');
    var na=$('#name').text();
    for (var i =0; i<=arr.length; i++) {
        if(arr.eq(i).text() == na){
            arr.eq(i).parent().attr('class','current');
        }
    }
    
</script>

@endsection