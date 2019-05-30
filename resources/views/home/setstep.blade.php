@extends('common/public')
@section('title', '确认订单')
@section('content')
@php
static $price=0;
static $onum=0;
static $gid='';
@endphp
<div class="container">
    <div class="xm-plain-box">
        <div class="box-hd">
            <h3 class="title">
                确认订单信息
            </h3>
        </div>
    </div>
    <div class="box-hd" id="cart_step" style="margin-top: 20px;">
        <form method="post" onsubmit="return check_step();" action="/cart/submit">
        	{{csrf_field()}}
            <div class="">
                <div class="span20" style="margin-bottom: 6px; font-size: 16px;">
                    <div class="span10" style="text-align: left; font-weight: bold;">
                        收货地址
                    </div>
                    <div class="span10" style="text-align: right;">
                        <a href="/cart/setaddress">
                            <重新选择收货地址
                        </a>
                    </div>
                </div>
                <div class="">
                    <input type="hidden" name="oname"  value="{{$rs->name}}">
                    <input type="hidden" name="uid" value="{{Session::get('id')}}">
                    <input type="hidden" name="oaddress" value="{{$rs->province}}-{{$rs->cont}}">
                    <input type="hidden" name="ophone" value="{{$rs->phone}}">
                   
                    <input type="hidden" name="oaddtime" value="{{time()}}">
                   
                    <label>
                        收货人：{{$rs->name}}
                    </label>
                    <label>
                        收货地址： {{$rs->cont}}, {{$rs->province}}
                    </label>
                    <label>
                        邮政编码：{{$rs->bian}}
                    </label>
                    <label>
                        手机号码：{{$rs->phone}}
                    </label>
                    	
                </div>
                <div class="">
                    <hr>
                    <h3>
                        配送方式
                    </h3>
                </div>
                <div class="">
                    <label class="radio no_cash_on_delivery selected">
                        
                        商家自动分配&nbsp;&nbsp;[
                        <strong>
                            费用：￥
                            <span id="addpress_price_7">
                                0.00
                            </span>
                            &nbsp;元
                        </strong>
                        ]
                    </label>
                </div>
                <div class="span20">
                    <hr>
                    <h3 class="span10">
                        商品清单
                    </h3>
                    <h3 class="span10" style="text-align: right;">
                        <a href="/user/cart">
                            <返回修改购物车
                        </a>
                    </h3>
                </div>
                <div class="span20 shop-cart-goods">
                    <table>
                        <thead>
                            <tr>
                                <th width="38%">
                                    产品
                                </th>
                                <th width="8%">
                                    货号
                                </th>
                                <th width="10%">
                                    规格
                                </th>
                                <th width="10%">
                                    数量
                                </th>
                                <th width="10%">
                                    价格
                                </th>
                                <th width="10%">
                                    总价
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                        	@foreach($arr as $v)
                        	@php
		            		 	$txgoods = DB::table('goods')->find($v->gid);
		                        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
		                        if($txgoods->gtock==0){
									DB::table('cart')->where('id',$v->id)->delete();
									continue;
				                    	}
				            @endphp
                            <tr>
                                <td>
                                    <a href="/goods/5/18">
                                        <img src="{{$mig->gpic}}"
                                        style=" height:65px;width:65px;border:1px solid #D7D7D7">
                                    </a>
                                    &nbsp;&nbsp;{{$txgoods->gname}}
                                </td>
                                <td>
                                   {{$txgoods->id}}
                                </td>
                                <td>
                                    型号:{{$txgoods->xinghao}}<br>
                       				 尺寸:{{$txgoods->size}}
                                </td>
                                <td>
                                    {{$v->num}}
                                </td>
                                <td>
                                    ￥{{$txgoods->gprice}}.00&nbsp;元
                                </td>
                                <td>
                                	@php
                                	$price+=$v->num*$txgoods->gprice;
                                	$onum++;
                                	@endphp
                                	@php
                                	$gid.=$txgoods->id.'-'.$v->num.'|';
                                	@endphp
                                    ￥{{$v->num*$txgoods->gprice}}.00&nbsp;元
                                </td>
                            </tr>
                            @endforeach


                            <tr>
                                <td colspan="6">
                                    <p style="text-align: right;">
                                        <span style="padding-right:40px;">
                                            <strong>
                                                应付金额：
                                                <font color="#ED145B">
                                                    ￥
                                                    <span id="goods_total_fee">
                                                       {{$price}} .00
                                                    </span>
                                                </font>
                                                + 配送费用：
                                                <font color="#ED145B">
                                                    ￥
                                                    <span id="express_fee">
                                                        0.00
                                                    </span>
                                                </font>
                                                + 支付手续费：
                                                <font color="#ED145B">
                                                    ￥
                                                    <span id="pay_fee">
                                                        0
                                                    </span>
                                                </font>
                                                - 购买优惠：
                                                <font color="#ED145B">
                                                    ￥
                                                    <span id="buy_pre_fee">
                                                        0.00
                                                    </span>
                                                </font>
                                                - 会员优惠：
                                                <font color="#ED145B">
                                                    ￥
                                                    <span id="user_pre_fee">
                                                        0
                                                    </span>
                                                </font>
                                            </strong>
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <p style="font-size:16px;margin-right:50px; color:#ED145B;text-align: right;">
                        <strong>
                            应付总金额：￥
                            <span id="order_total_fee">
                               <font id='count'>{{$price}}</font>.00
                            </span>
                            &nbsp;元
                        </strong>
                    </p>
                    <input type="hidden" id="user_pre_price" name="ototal" value="{{$price}}">
                    
                </div>
                <div class="">
                    <hr>
                    <h3>
                        支付方式
                    </h3>
                </div>
                <div class="">
                    <label>
                        <input type="radio"  id='xxoo'  value="xxzf"  disabled>
                        <img src="/gw/xxzf.gif" style="border:1px solid #D7D7D7; margin-left:8px;">
                        &nbsp;[
                        <strong>
                            手续费：￥
                            <span id="payment_price_xxzf">
                                0
                            </span>
                            &nbsp;元
                        </strong>
                        ]&nbsp;
                        <small>
                            线下支付
                        </small>
                    </label>
                    <label>
                        <input type="radio"  checked value="yezf" >
                        <img src="/gw/yezf.gif" style="border:1px solid #D7D7D7; margin-left:8px;">
                        &nbsp;[
                        <strong>
                            手续费：￥
                            <span id="payment_price_yezf">
                                0
                            </span>
                            &nbsp;元 &nbsp;|&nbsp;余额：0.00
                        </strong>
                        ]&nbsp;
                        <small>
                            余额支付，使用会员账户余额进行付款
                        </small>
                    </label>
                    <label>
                        <input type="radio" value="hdfk">
                        <img src="/gw/hdfk.gif" style="border:1px solid #D7D7D7; margin-left:8px;">
                        &nbsp;[
                        <strong>
                            手续费：￥
                            <span id="payment_price_hdfk">
                                0
                            </span>
                            &nbsp;元
                        </strong>
                        ]&nbsp;
                        <small>
                            货到付款
                        </small>
                    </label>
                </div>
                <div class="">
                    <hr>
                    <h3>
                        买家留言
                    </h3>
                </div>
                <div class="">
                    <textarea class="span9" id="order_message" name="omsg" rows="2">
                    </textarea>
                </div>
                <div class="">
                    <hr>
                    <div style="text-align: center;">
                        <input type="hidden" name="ostatus" value="0">
                        <input type="hidden" name="dhao" value="{{strtoupper(md5(rand(11111,99999)))}}">
                        <input type="hidden" name="kdd" value="0">
                        <input type="hidden" name="good" value="{{$gid}}">
                         <input type="hidden" name="onum" value="{{$onum}}">
                        <input type="submit" class="btn btn-large btn-primary" onclick=" return gogo()" value="确认订单">
                        &nbsp;&nbsp;
                        <input type="button" class="btn" style="vertical-align:bottom;" onclick="location.href='/cart/setaddress'"
                        value="返回上一步">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
function gogo(){
       if($('#count').text()=='0'){
            alert('亲,没有商品哦!');
            return false;
       }
    }

</script>
@stop