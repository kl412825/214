@extends('common/public')
@section('title', '下单')
@section('content')
	<div class="container">
    <div class="xm-plain-box">
        <div class="box-hd">
            <h3 class="title">
                恭喜您！订单提交成功，祝您购物愉快！
            </h3>
        </div>
    </div>
    <div class="box-hd">
        <p style="font-size:16px;">
            <strong>
                您当前的订单金额：
                <font color="color:#ED145B">
                    ￥{{$rs->ototal}}.00&nbsp;元
                </font>
            </strong>
        </p>
        <p style="font-size:16px;">
            <strong>
                请牢记您的订单号：
                <font color="color:#ED145B">
                    {{$rs->dhao}}
                </font>
            </strong>
        </p>
        <hr>
        <p style="text-align: center;">
            <input type="button" class="btn" onclick="location.href='/'" value="继续去购物">
            &nbsp;&nbsp;
            <input type="button" class="btn" onclick="location.href='/home/order/index/state/30'"
            value="查看订单详情">
        </p>
    </div>
</div>
@stop