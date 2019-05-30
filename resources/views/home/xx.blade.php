@extends('home/self')
@section('name', '中心首页')
@section('gai')
	<div class="span16">
    <div class="xm-box uc-box">
        <div class="xm-line-box uc-info-box">
            <div class="box-bd clearfix">
                <img alt="" src="{{$rs->profile}}" class="uc-avatar">
                <div class="uc-info">
                    <h3 class="uc-welcome">
                        <span class="user-name">
                            <a href="/home/useredit">
                                {{$rs->uname}}
                            </a>
                        </span>
                    </h3>
                    <div class="uc-info-detail">
                        <div class="info-notice">
                            用户等级：{{$rs->uauth}}
                            <span class="sep">
                                |
                            </span>
                            账户余额：￥0.00&nbsp;元
                            <a href="/home/money" class="btn btn-small btn-primary" style="width: 50px;height:">
                                充值
                            </a>
                            <span class="sep">
                                |
                            </span>
                            消费积分：0
                            <span class="sep">
                                |
                            </span>
                            等级积分：0
                            <br>
                            用户提醒：
                            <a href="/home/order/index/state/10">
                                <span class="badge badge-important">
                                    待付款订单({{$brr[3] or 0}})
                                </span>
                            </a>
                            &nbsp;&nbsp;
                            <a href="/home/order/index/state/30">
                                <span class="badge badge-important">
                                    待发货订单({{$brr[0] or 0}})
                                </span>
                            </a>
                            &nbsp;&nbsp;
                            <a href="/home/order/index/state/40">
                                <span class="badge ">
                                    已发货订单({{$brr[1] or 0}})
                                </span>
                            </a>
                        </div>
                        
                    </div>
                </div>
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
                                订单编号：<a href="">{{$v->dhao}}</a>
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
                                    <span class="goods-price">￥{{$txgoods->gprice}}.00&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量:{{$num[1]}}</span>
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
                                <a href="/home/order/showorder/8/30">订单详情</a>
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
                                订单编号：<a href="">{{$v->dhao}}</a>
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
                                                ￥{{$txgoods->gprice}}.00&nbsp;元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量:{{$num[1]}}
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
                                        <a href="/home/order/showorder/3/15">
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
@stop