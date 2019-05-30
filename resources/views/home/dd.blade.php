@extends('home/self')
@section('name', '我的订单')
@section('gai')
<div class="span16">
    <div class="xm-line-box uc-box">
        <h3 class="right-more-title">
            <form class="form-search" style="margin: 0;" method="get">
                我的订单
                
            </form>
        </h3>
        <div class="box-hd-more">
            <div class="pull-left left-menu-more">
                <div id='kas'class="uc-order-list-type">
                    <a class="" href="/home/user/dd">
                        所有订单
                        <span  class="badge">
                           @php
                           	$co=0;
							foreach($brr as $v){
								$co+=$v;
							}
							echo $co;
                           @endphp
                        </span>
                    </a>
                    
                    
                    
                    <span class="sep">
                        |
                    </span>
                    <a  href="/home/user/dd?ac=0">
                        未发货
                        <span class="badge">
                            {{$brr[0] or 0}}
                        </span>
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/user/dd?ac=1">
                        已发货
                        <span class="badge">
                            {{$brr[1] or 0}}
                        </span>
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/user/dd?ac=2">
                        确认收货
                        <span class="badge">
                            {{$brr[2] or 0}}
                        </span>
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/user/dd?ac=3">
                        未付款
                        <span class="badge">
                            {{$brr[3] or 0}}
                        </span>
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/user/dd?ac=4">
                        无效订单
                        <span class="badge">
                            {{$brr[4] or 0}}
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="uc-box">
        <div class="uc-order-list-box">
            <ul class="uc-order-detail-list">
            	@foreach($crr as $v)
            	@php

            	$xxoop= explode('|',$v->good);
            	array_pop($xxoop);           	           	
            	@endphp
            	@if(count($xxoop)!=1)
            	<!-- 多商品 -->
                <li class="uc-order-detail-item">
					<table class="order-detail-table">
                    <thead>
                    <tr>
                        <th colspan="3" class="column-info column-t">
                            <div class="column-content">
                                <span class="order-status">{{$ddr[$v->ostatus]}}</span>
                                订单编号：<a href="/home/order/showorder/8/30">{{$v->dhao}}</a>
                                <span class="sep">|</span>
                               	{{$rs->uname}}<span class="sep">|</span>
                                {{date('Y-m-d H:i:s',$v->oaddtime)}}</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="column-detail column-l">
                            <ul class="order-goods-list">

                            	@foreach($xxoop as $v1)
                            	@php
                            	$num = explode('-',$v1);
                            	$txgoods = DB::table('goods')->find($num[0]);
		                        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
		                        @endphp
                                <li class="first">
                                    <a href="/goods/gxq/{{$v1}}" target="_blank">
                                        <img src="{{$mig->gpic}}" class='goods-thumb'>
                                    </a>
                                    <a class="goods-name" href="/goods/gxq/{{$v1}}" target="_blank">{{$txgoods->gname}}</a>
                                    <span class="goods-price">￥{{$txgoods->gprice}}.00&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量:{{$num[1]}}</span><button class="btn btn-small" onclick='addcart({{$txgoods->id}})'>再次购买</button>
                                    <span></span>
                                </li>
                                @endforeach                                
                          	</ul>
                        </td>
                        <td class="column-price">
                            <div class="order-info order-price">￥{{$v->ototal}}.00&nbsp;元</div>
                        </td>
                        <td class="column-action column-r">
                            <div class="order-info order-action">
                                <a href="/home/order/showorder/{{$v->id}}">订单详情</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                	</table>
                </li>
                @else
                <!-- 单商品 -->
                @php
                $num = explode('-',$xxoop[0]);
                
             	$txgoods = DB::table('goods')->find($num[0]);
		        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
		        @endphp
                <li class="uc-order-detail-item">
                    <table class="order-detail-table">
                        <thead>
                         <tr>
                        <th colspan="3" class="column-info column-t">
                            <div class="column-content">
                                <span class="order-status">{{$ddr[$v->ostatus]}}</span>
                                订单编号：<a href="/home/order/showorder/8/30">{{$v->dhao}}</a>
                                <span class="sep">|</span>
                               	{{$rs->uname}}<span class="sep">|</span>
                                {{date('Y-m-d H:i:s',$v->oaddtime)}}</div>
                        </th>
                    </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="column-detail column-l">
                                    <ul class="order-goods-list">
                                        <li class="first">
                                            <a href="/goods/gxq/{{$xxoop[0]}}" target="_blank">
                                                <img src="{{$mig->gpic}}" class='goods-thumb'>
                                            </a>
                                            <a class="goods-name" href="/goods/gxq/{{$xxoop[0]}}" target="_blank">
                                                {{$txgoods->gname}}
                                            </a>
                                            <span class="goods-price">
                                                ￥{{$txgoods->gprice}}.00&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量:{{$num[1]}}<br><button class="btn btn-small" onclick='addcart({{$txgoods->id}})'>再次购买</button>
                                            </span>
                                            <span>
                                            </span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="column-price">
                                    <div class="order-info order-price">
                                        ￥{{$v->ototal}}.00&nbsp;元
                                    </div>
                                </td>
                                <td class="column-action column-r">
                                    <div class="order-info order-action">
                                        <a href="/home/order/showorder/{{$v->id}}">
                                            订单详情
                                            
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                @endif
				@endforeach
            </ul>
        </div>
    </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
<script type="text/javascript">
	function GetUrlParam(paraName) {
　　　　var url = document.location.toString();
　　　　var arrObj = url.split("?");

　　　　if (arrObj.length > 1) {
　　　　　　var arrPara = arrObj[1].split("&");
　　　　　　var arr;

　　　　　　for (var i = 0; i < arrPara.length; i++) {
　　　　　　　　arr = arrPara[i].split("=");

　　　　　　　　if (arr != null && arr[0] == paraName) {
　　　　　　　　　　return arr[1];
　　　　　　　　}
　　　　　　}
　　　　　　return "";
　　　　}
　　　　else {
　　　　　　return "";
　　　　}
　　}
	if (true) {}
	var kas=GetUrlParam('ac');
	if(kas==''){
		kas=-1;
	}
	// $('#kas a').[parseInt(kas)+1].className='current';
	console.log();
	$('#kas a').eq(parseInt(kas)+1).attr('class','current');





	function addcart(gid){
         $.get('/user/addcart',{'gid':gid},function(data){
                if (data ==9){
                   swal("购物车", "商品不足!","error");
                    
                }else if(data ==1){
                    swal("已帮您加入购物车", "点击购物车查询!");
                    
                }else if(data ==2){
                    swal("已帮您加入购物车", "点击购物车查询!");
                    xoxo= parseInt($('#gwc').text()) +1;
                    $('#gwc').text(xoxo);
                }
            })
    };
</script>
@stop