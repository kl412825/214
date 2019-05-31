@extends('common/public')
@section('title', '选择地址')
@section('content')
	<div class="container">
    <div class="xm-plain-box">
        <div class="box-hd">
            <h3 class="title">
                收货地址选择
            </h3>
        </div>
    </div>
    <div class="box-hd">
        <form method="get" onsubmit="return check_address_id();" action="/cart/setstep">
            <div>
                <div style="margin-bottom: 10px;">
                    <a href="/user/site" class="btn btn-small btn-primary" type="button" onclick="ajax_add_address(0);">
                        <i class="icon-plus icon-white">
                        </i>
                        添加收货地址
                    </a>
                </div>
                <div class="buy_address" id="cart_step">
                	@foreach($rs as $v)
                    <label class="radio selected">
                        <input id="chedo" type="radio" name="id" @if($v->moren==1)  checked  @endif value="{{$v->id}}">
                        <font>{{$v->name}}</font>
                        <br>
                        <font>{{$v->cont}}</font>
                        <br>
                        <font>{{$v->province}}</font>&nbsp;&nbsp; 邮编 <font>{{$v->bian}}</font>&nbsp;&nbsp;手机 <font>{{$v->phone}}</font>
                        <span style=" float:right; padding-right:50px;">
                            
                        </span>
                    </label>
                    @endforeach
                </div>
                <div>
                    <hr>
                    <div style="text-align: center;">
                        
                        <input type="submit" class="btn btn-large btn-primary" value="下一步">
                        &nbsp;&nbsp;
                        <input type="button" class="btn" style="vertical-align:bottom;" onclick="location.href='/user/cart'"
                        value="修改购物车">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
   function check_address_id(){
        if ($('#cedo').val()==undefined) {
            alert('请先添加收货地址');
            return false;
        }
        
   }
</script>
@stop
