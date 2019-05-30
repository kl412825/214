@extends('home/self')
@section('name', '我的订单')
@section('gai')
	<div class="span16">
		<style type="text/css">
			#gogo{
				display:none;
			}
		</style>
    <div class="xm-line-box uc-box uc-order-detail-box">
        <div class="box-hd">
            <h3 class="title">
                订单编号：{{$rs->dhao}}
            </h3>
            <div class="more">
                订单状态：{{$brr[$rs->ostatus]}}
                	
                <a href="/home/user/dd" class="btn btn-primary btn-small">
                    返回订单列表
                </a>
            </div>
        </div>
        @php
			$gid = explode('|',$rs->good);
			array_pop($gid);
        @endphp
        <div class="box-bd">
            <div class="order-detail-tables">
                <table class="order-detail-table">
                    <thead>
                        <tr>
                            <th colspan="5" class="column-info">
                                <div class="column-content">
                                    快递单号： @if($rs->kdd==0)  无(未发货)  @endif
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($gid as $v)
                    	@php
							$gido = explode('-',$v);
							$txgoods = DB::table('goods')->find($gido[0]);
		                    $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
				        @endphp
                        <tr>
	            	<font id ='zt' style="display:none;">{{$rs->ostatus}}</font>
                            <td class="column-detail">
                                <ul class="order-goods-list">
                                    <li class="first">
                                        <a href="/goods/4/19" target="_blank">
                                            <img  src="{{$mig->gpic}}"
                                            class="goods-thumb">
                                        </a>
                                        <a class="goods-name" href="/goods/4/19" target="_blank">
                                           {{$txgoods->gname}}
                                        </a>
                                        <span class="goods-price">
                                            ￥{{$txgoods->gprice}}.00&nbsp;元
                                        </span>
                                        <span class="goods-amount">
                                            x {{$gido[1]}}
                                        </span>
                                    </li>
                                </ul>
                            </td>
                            <td class="column-price">
                                <div class="order-info order-price">
                                    {{$txgoods->id}}
                                </div>
                            </td>
                            <td class="column-date">
                                型号:{{$txgoods->xinghao}}<br>
                        		尺寸:{{$txgoods->size}}
                            </td>
                            <td class="column-action">
                                <strong>
                                    ￥{{$txgoods->gprice*$gido[1]}}.00&nbsp;元
                                </strong>
                            </td>
                            <td class="column-action">
                            </td>
                        </tr>
						@endforeach
                        <tr>
                            <td colspan="5" class="column-delivery">
                                <div class="order-delivery-status">
                                    <ol class="order-delivery-steps clearfix">
                                        <li class="step step-first step-now">
                                            <div class="progress">
                                                <span class="text">
                                                    下单
                                                </span>
                                            </div>
                                            <div class="info">
                                                {{date('Y-m-d H:i:s',$rs->oaddtime)}}
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="progress">
                                                <span class="text">
                                                    付款
                                                </span>
                                            </div>
                                            <div class="info">
                                            </div>
                                        </li>
                                        <li class="step ">
                                            <div class="progress">
                                                <span class="text">
                                                    发货
                                                </span>
                                            </div>
                                            <div class="info">
                                            </div>
                                        </li>
                                        <li class="step step-last ">
                                            <div class="progress">
                                                <span class="text">
                                                    完成
                                                </span>
                                            </div>
                                            <div class="info">
                                            </div>
                                        </li>
                                    </ol>

                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="order-detail-total clearfix">
                    <dl class="total-list">
                        <dt>
                            商品总计：
                        </dt>
                        <dd>
                            ￥{{$rs->ototal}}.00
                        </dd>
                        <dt>
                            购买优惠：
                        </dt>
                        <dd>
                            -￥0.00
                        </dd>
                        <dt>
                            会员优惠：
                        </dt>
                        <dd>
                            -￥0
                        </dd>
                        <dt>
                            商品运费：
                        </dt>
                        <dd>
                            ￥0.00
                        </dd>
                        <dt>
                            支付手续：
                        </dt>
                        <dd>
                            ￥0
                        </dd>
                        <dt>
                            订单总额：
                        </dt>
                        <dd>
                            <b>
                                ￥{{$rs->ototal}}.00
                            </b>
                            &nbsp;元
                        </dd>
                        <dd>
                            <button class='btn' id='gogo' onclick="status({{$rs->id}})" >确认收货</button>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="order-delivery-address">
            <div class="order-text-section">
                <h4>
                    支付信息
                </h4>
                <table class="order-text-table">
                    <tbody>
                        <tr>
                            <th>
                                支付方式：
                            </th>
                            <td>
                            	@php
                            	$kas=['余额支付','货到付款'];
                            	echo $kas[$rs->ff];
                            	@endphp
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="order-text-section">
                <h4>
                    配送信息
                </h4>
                <table class="order-text-table">
                    <tbody>
                        <tr>
                            <th>
                                收货人员：
                            </th>
                            <td>
                                {{$rs->oname}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                快递信息：
                            </th>
                            <td>
                                商家自动分配
                            </td>
                        </tr>
                        <tr>
                            <th>
                                收货地址：
                            </th>
                            <td>
                                {{$rs->oaddress}}
                                <br>
                                &nbsp;
                            </td>

                        </tr>

                       
                        <tr>
                            <th>
                                手机号码：
                            </th>
                            <td>
                               {{$rs->ophone}}
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var zt=$('#zt').text();
	
	if(zt=='0'){
		$('.step').eq(1).addClass('step-now');	
	}else if(zt=='1'){
		$('.step').eq(1).addClass('step-now');	
		$('.step').eq(2).addClass('step-now');
		$('#gogo').css('display','block');
	}else if(zt=='2'){
		//完成
		$('.step').eq(1).addClass('step-now');	
		$('.step').eq(2).addClass('step-now');	
		$('.step').eq(3).addClass('step-now');	
	}else if(zt=='3'){
		$('.step').eq(2).addClass('step-now');
		$('#gogo').css('display','block');

	}
	function status(id){
		$.post('/home/questatus',{'id':id,'_token':'{{csrf_token()}}'},function(){
			window.location.href = '/home/order/showorder/'+id;
		})
	}
</script>
@stop