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
	<div class="shop-cart-box" style="width:65%;margin:0 auto;">
    <div class="shop-cart-box-hd">
        <h2 class="title">
            我的购物车
        </h2>
    </div>
    <div class="shop-cart-box-bd shop-cart-goods">
        <!-- 购物车商品列表 -->
        <table>
            <thead>
                <tr>
                	<th width="5%">
                        
                    </th>
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
            <tbody>
                <tr>
                	<td><div id='check' class='yes'></div></td>
                    <td>
                        <a href="/goods/6/30">
                            <img src="/public/demo/goods/20190207/thumb_1bb0543aa7433fca1e25a06c75ef8f8d.jpg"
                            style=" height:65px;width:65px;border:1px solid #D7D7D7">
                        </a>
                        &nbsp;&nbsp;美的（Midea）BCD-525WKPZM(E) 星际银 525升对开门电冰箱
                    </td>
                    <td>
                        DBS000006
                    </td>
                    <td>
                        无
                    </td>
                    <td>
                        <select id="6buy_num" name="6buy_num" onchange="edit_cart_goods_buy_num('6','6buy_num');">
                            <option value="1" selected="selected">
                                1
                            </option>
                            <option value="2">
                                2
                            </option>
                            <option value="3">
                                3
                            </option>
                            <option value="4">
                                4
                            </option>
                            <option value="5">
                                5
                            </option>
                            <option value="6">
                                6
                            </option>
                            <option value="7">
                                7
                            </option>
                            <option value="8">
                                8
                            </option>
                            <option value="9">
                                9
                            </option>
                            <option value="10">
                                10
                            </option>
                            <option value="11">
                                11
                            </option>
                            <option value="12">
                                12
                            </option>
                            <option value="13">
                                13
                            </option>
                            <option value="14">
                                14
                            </option>
                            <option value="15">
                                15
                            </option>
                            <option value="16">
                                16
                            </option>
                            <option value="17">
                                17
                            </option>
                            <option value="18">
                                18
                            </option>
                            <option value="19">
                                19
                            </option>
                            <option value="20">
                                20
                            </option>
                            <option value="21">
                                21
                            </option>
                            <option value="22">
                                22
                            </option>
                            <option value="23">
                                23
                            </option>
                            <option value="24">
                                24
                            </option>
                            <option value="25">
                                25
                            </option>
                            <option value="26">
                                26
                            </option>
                            <option value="27">
                                27
                            </option>
                            <option value="28">
                                28
                            </option>
                            <option value="29">
                                29
                            </option>
                            <option value="30">
                                30
                            </option>
                            <option value="31">
                                31
                            </option>
                            <option value="32">
                                32
                            </option>
                            <option value="33">
                                33
                            </option>
                            <option value="34">
                                34
                            </option>
                            <option value="35">
                                35
                            </option>
                            <option value="36">
                                36
                            </option>
                            <option value="37">
                                37
                            </option>
                            <option value="38">
                                38
                            </option>
                            <option value="39">
                                39
                            </option>
                            <option value="40">
                                40
                            </option>
                            <option value="41">
                                41
                            </option>
                            <option value="42">
                                42
                            </option>
                            <option value="43">
                                43
                            </option>
                            <option value="44">
                                44
                            </option>
                            <option value="45">
                                45
                            </option>
                            <option value="46">
                                46
                            </option>
                            <option value="47">
                                47
                            </option>
                            <option value="48">
                                48
                            </option>
                            <option value="49">
                                49
                            </option>
                            <option value="50">
                                50
                            </option>
                        </select>
                    </td>
                    <td>
                        ￥3099.00&nbsp;元
                    </td>
                    <td>
                        ￥3099&nbsp;元
                    </td>
                    <td>
                        <a href="javascript:;" onclick="del_cart_goods('6');">
                            删除
                        </a>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <div class="shop-cart-box-ft clearfix">
        <div class="shop-cart-total">
            <span class="pull-right" style="text-align:right;">
                <strong>
                    应付总额（
                    <font color="#139EE6">
                        不含运费
                    </font>
                    ）：
                    <font size="5" color="#ff4a00">
                        ￥14297&nbsp;元
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
                    <a href="/cart/clearCartGoods" onclick="return window.confirm('您确实要清空购物车吗？');">
                        <i class="iconfont">
                            
                        </i>
                        清空购物车
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('#check').click(function(){
		if($(this).attr('class')=='yes'){
			$(this).attr('class','no');
		}else{
			$(this).attr('class','yes');
		}
		
	});
</script>
@stop