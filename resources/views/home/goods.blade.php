@extends('common/public')

@section('title',$title)

@section('type')

@stop
@section('content')
<div class="container breadcrumbs">
    <a href="/">首页</a><span class="sep">/</span>
   
       <span>{{$tt}}</span>
      
</div>
<div class="container">
    <div class="row">
        <div class="col col-4">
            <div class="goodslist-left-sidebar">
                <div class="left-title">
                    当前分类
                </div>
                 @php
			     use App\Http\Controllers\Admin\TypeController;
			        $res = TypeController::getfenleiMessage(0);
			       
			     @endphp
                <div class="left-sidebar-content">
                    <ul class="list-unstyled goodsclass-list">
                    	@foreach($res as $v)
                    	 @if($v->status ==1)

                        <li class="active">
                            <span>
                            </span>
                            
                                {{$v->tname}}
                            
                            @endif
                           

                            <ul class="list-unstyled" style="display: none">
                            
                            @foreach($v->sub as $v1)
                         	@if($v1->status ==1)
                                <li class="" >
                                    <span>
                                    </span>
                                    <a href="/goods/{{$v1->id}}">
                                       {{$v1->tname}}
                                    </a>
                                </li>
                                @endif
                           @endforeach
                            </ul>
                        </li>
                   
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col col-16">
            <div class="goodslist-right">
                <div class="xm-line-box filter-box">
                    <div class="box-hd">
                        <h3 class="title">
                            {{$ty}}
                        </h3>
                    </div>
                    <div class="box-bd">
                        <div class="filter-lists">
                        </div>
                    </div>
                </div>
                <div class="xm-line-box goods-list-box">
                    <div class="box-hd">
                        <div class="filter-lists">
                            <dl class="xm-filter-list xm-filter-list-first category-filter-list clearfix">
                                <dd>
                                    <ul class="clearfix" id="typeOrder">
                                        <li class="current first">
                                            <a rel="nofollow" href="/list/1">
                                                最新
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow " id="btn" href="/goods/{{$id}}?id=s">
                                                价格从高到低
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="/goods/{{$id}}?id=a">
                                                价格从低到高
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="more">
                            <div class="filter-stock">
                                共
                                <font color="#ED154B">
                                    {{$s}}
                                </font>
                                商品
                            </div>
                        </div>
                    </div>
                    <div class="box-bd">
                        <div class="goods-list-section">
                            <div class="xm-goods-list-wrap xm-goods-list-wrap-col20" style="padding-bottom: 60px;">
                                <ul class="xm-goods-list clearfix">

									@php
										
									use App\Model\Admin\img;
									@endphp
                                	@foreach($rs as $v)
                                    @if($v->gstatus ==1 )
										@php
											$a = img::where('gid',$v->id)->first();
										@endphp
                                    <li class="">
                                        <div class="xm-goods-item">
                                            <div class="item-thumb">
                                                <a href="/goods/gxq/{{$v->id}}" title="{{$v->gname}}">
                                                	
                                                	<img alt="{{$v->gname}}" src="{{$a->gpic}}">   
                                                </a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-price">
                                                    <span id="goods_price_7">
                                                        ￥{{$v->gprice}}&nbsp;元
                                                    </span>
                                                </div>
                                                <h3 class="item-title">
                                                    <a href="/goods/gxq/{{$v->id}}" title="西门子（SIEMENS） XQG100-WM14U561HW 10公斤 变频 一键智能除渍">
                                                       {{$v->gname}}
                                                    </a>
                                                </h3>
                                                <div class="item-star">
                                                   {{$v->gname}}
                                                </div>
                                                <div class="item-actions item_goods_7">
                                                    <a onclick="addcart({{$v->id}});" href="javascript: void(0);" class="btn btn-small btn-primary J_addCart">
                                                        
                                                        购物车
                                                    </a>
                                                    <a onclick="add_fav({{$v->id}});" href="javascript: void(0);" class="btn btn-dake btn-small J_addFav">
                                                        <i class="iconfont">
                                                            
                                                        </i>
                                                        收藏
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                   @endforeach
                                </ul>
                            </div>
                            <div class="xm-pagenavi">
                                <span class="numbers first iconfont">
                                    
                                </span>
                                <span class="numbers current">
                                    1
                                </span>
                                <span class="numbers last iconfont">
                                    
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
  @section('js')
   <link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
 <script type="text/javascript">

	$('.active').click(function(){

		$(this).find('.list-unstyled').show();
		
	});
 

function addcart(gid){
         $.get('/user/addcart',{'gid':gid},function(data){
                if (data ==9){
                   swal("购物车", "商品不足!","error");
                    
                }else if(data ==1){
                    swal("购物车", "添加购物车成功,点击购物车查询!","success");
                    
                }else if(data ==2){
                    swal("购物车", "添加购物车成功,点击购物车查询!","success");
                    xoxo= parseInt($('#gwc').text()) +1;
                    $('#gwc').text(xoxo);
                }else{
                    swal({ 
                    title: "请先 登录", 
                    text: "是 否 去 登 陆", 
                    type: "warning",
                    showCancelButton: true, 
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "去登陆！", 
                    cancelButtonText: "暂不！",
                    closeOnConfirm: false, 
                    closeOnCancel: false    
                    },
                    function(isConfirm){ 
                    if (isConfirm) {
                       window.location.href="/home/user/login ";
                    } else { 
                        swal("取消", "取消登录"); 
                    } 
            });

                }
            })
    }
function add_fav(gid){

            $.get('/home/user/select/balance',{'gid':gid},function(data){
                if (data ==1){
                    swal("收藏", "收藏成功,点击个人收藏查询!","success");
                    
                }else if(data ==0){
                    swal("收藏", "此商品已经被收藏,点击个人收藏查询!","error");
                }else{
                    swal({ 
                    title: "请先 登录", 
                    text: "是 否 去 登 陆", 
                    type: "warning",
                    showCancelButton: true, 
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "去登陆！", 
                    cancelButtonText: "暂不！",
                    closeOnConfirm: false, 
                    closeOnCancel: false    
                    },
                    function(isConfirm){ 
                    if (isConfirm) {
                       window.location.href="/home/user/login ";
                    } else { 
                        swal("取消", "取消登录"); 
                    } 
    });

                }
            })
            
            
        }
</script>
@stop
 