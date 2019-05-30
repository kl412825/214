@extends('common/public')
@section('title','购物车')
@section('content')
	<style type="text/css">
		.no{
			border:1px solid gray; 
			width:30%;
			height:13px;
		}
		.yes{
			/*border:1px solid gray; */
			width:30%;
			height:13px;
			background: pink;
		}


	</style>
	<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
	<div class="shop-cart-box" style="width:65%;margin:0 auto;">
    <div class="shop-cart-box-hd">
        <h2 class="title">
            我的购物车
        </h2>
    </div>
    <div  class="shop-cart-box-bd shop-cart-goods">
        <!-- 购物车商品列表 -->
        <table>
            <thead>
                <tr>
                	
                    <th width="38%">
                        商品
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
                    <th width="5%">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody id='del' >
            	@foreach($rs as $v)
            	@php
            		 	$txgoods = DB::table('goods')->find($v->gid);
                        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
                        if($txgoods->gtock==0){
							DB::table('cart')->where('id',$v->id)->delete();
							continue;
                    	}
            	@endphp
                <tr  class='tr{{$v->id}}'>
                	
                    <td>
                        <a href="/goods/6/30">
                            <img src="{{$mig->gpic}}"
                            style=" height:65px;width:65px;border:1px solid #D7D7D7">
                        </a>
                        &nbsp;&nbsp;<font style="text-align:center;">{{$txgoods->gname}}</font >
                    </td>
                    <td>
                        {{$txgoods->id}}
                    </td>
                    <td>
                        型号:{{$txgoods->xinghao}}<br>
                        尺寸:{{$txgoods->size}}
                    </td>
                    <td>

						
                        <select class='select{{$v->id}}' onchange="selectdd({{$v->id}})">
                        	@for($i=1; $i<=$txgoods->gtock ;$i++)
							<option value='{{$i}}' @if($v->num==$i) selected  @endif>{{$i}}</option>
							@endfor
                        </select>
                    </td>
                    <td>
                        ￥<font class="danjia{{$v->id}}">{{$txgoods->gprice}}</font>.00&nbsp;元
                    </td>
                    <td >
                        ￥<font class="price price{{$v->id}}">{{$v->num * $txgoods->gprice}}</font>.00&nbsp;元
                    </td>
                    <td>
                        <a  onclick="del({{$v->id}})">
                            删除
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div ' class="shop-cart-box-ft clearfix">
        <div class="shop-cart-total">
            <span class="pull-right" style="text-align:right;">
                <strong>
                    应付总额（
                    <font color="#139EE6">
                        不含运费
                    </font>
                    ）：
                    <font size="5" color="#ff4a00">
                        ￥<font id='count'>14297</font>&nbsp;元
                    </font>
                </strong>
                <br>
            </span>
        </div>
        <div class="shop-cart-action clearfix">
            <a class="btn btn-primary btn-next" href="/cart/setaddress">
                去结算
            </a>
            <a class="btn btn-lineDakeLight btn-back" href="/">
                继续去购物
            </a>
            <div class="tips">
                <span class="shop-cart-coudan">
                    <a onclick="delkk()">
                        <i class="iconfont">
                            
                        </i>
                        清空购物车
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function xuan(id){

		if($('#check'+id).attr('class')=='yes'){
			$('#check'+id).attr('class','no');
		}else{
			$('#check'+id).attr('class','yes');
		}
	}
	function price(){
		var count=0;
		var price = $('.price');
		for(var i=0;i<price.length;i++){
			
			count+=parseInt(price[i].innerText);
			
		}
		$('#count').text(count);
	}
	price();
	function selectdd(gid){
		var num = parseInt($('.select'+gid).val());
		$.post('/user/addcart/upnum',{'num':num,'id':gid,'_token':'{{csrf_token()}}'},function(data){
			//修改总价格
			$('.price'+gid).text(num*parseInt($('.danjia'+gid).text()));
			price();
		})
		console.log(num)

	}
	function delkk(){
		$.post('/user/addcart/upnum',{'ac':'del','_token':'{{csrf_token()}}'},function(data){

			$('#del').remove();
			price();
		})
	}
	function del(id){
		 swal({ 
           title: "删除购物车", 
           text: "是 否 确定删除购物车商品", 
           type: "warning",
           showCancelButton: true, 
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "是！", 
           cancelButtonText: "否！",
           closeOnConfirm: false, 
           closeOnCancel: false    
           },
           function(isConfirm){ 
           if (isConfirm) {
           	$.post('/user/addcart/del',{'id':id,'_token':'{{csrf_token()}}'},function(data){

			
			})

              swal("提示", "删除成功"); 	
              $('.tr'+id).remove();
              price();
           } else { 
               swal("提示", "删除失败"); 
           } 

	})
	}
</script>
@stop