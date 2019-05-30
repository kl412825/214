@extends('home/self')
@section('name', '账户余额')
@section('gai')
	<div class="xm-line-box uc-box">
    <h3 class="right-more-title">
        <form class="form-search" style="margin: 0;" method="get">
            账户余额 [
            <font color="#dd4b39">
                ￥0.00&nbsp;元
            </font>
            ]
        
        </form>
    </h3>
    <div class="box-hd-more">
        <div class="span16">
            <div class="span12 pull-left left-menu-more">
                <div class="uc-order-list-type">
                    <a href="/home/money" class="current">
                        账户余额记录
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/money/paylog">
                        账户消费记录
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="/home/money/paychecklog">
                        账户充值记录
                    </a>
                    <span class="sep">
                        |
                    </span>
                    <a href="">
                        账户提现记录
                    </a>
                    
                   
                </div>
            </div>
            <div class="span4 pull-right">
                <a href="javascript:;" onclick="my_pay_to();" class="btn btn-primary btn-small">
                    充值
                </a>
                <a href="javascript:;" class="btn btn-danger btn-small" onclick="money_oper();">
                    提现
                </a>
            </div>
        </div>
    </div>
    <div class="box-bd">
        暂无记录！
    </div>
</div>
@stop