@extends('common/public')
<link rel='stylesheet' href='/fd/main.css'>
    <link rel='stylesheet' href='/fd/hizoom.min.css'>
@section('title',$title)

@section('content')

<div class="container breadcrumbs" >
    <a href="/">
        首页
    </a>
    <span class="sep">
        /
    </span>
    <a href="/list/1">
        {{$ts->tname}}
    </a>
    <span class="sep">
        /
    </span>
    <a href="/list/6">
        {{$ty->tname}}
    </a>
    <span class="sep">
        /
    </span>
    <span>
       
       {{$rs->gname}}
    </span>
</div>
<div class="goods-detail container">
    <form action="/cart" method="post" name="add_goods_cart" id="add_goods_cart">
        <div class="goods-detail-info row clearfix">
            <div class="span15">
                <div style="font-size: 23px; font-weight: bold; color: #333;">
                   {{$rs->gname}}
                    <span style="color: #ed145b;">
                        {{$rs->size}}
                    </span>
                </div>
                <div class="span8 J_mi_goodsPic_block">
                    <div id="J_mi_goodsPicBox" class="goods-pic-box ">
                        <div style="margin: 20px 0 10px; width: 430px;height: 410px;">
                            
                                <div class="zoomPad" >
                                <div class='hizoom hi1'>
                                    <img class="goods-big-pic" src="/public/demo/goods/20190207/c534950c4a79ea20293e483fd4ed4aff.jpg"
                                    title="" style="opacity: 1;">
                                </div>
                                    <div class="zoomPup" style="top: 62.5px; left: 148px; width: 161px; height: 161px; position: absolute; border-width: 1px; display: block;">
                                    </div>
                                    <div class="zoomWindow" style="position: absolute; z-index: 5001; left: 440px; top: 0px; display: block;">
                                        <div class="zoomWrapper" style="width: 300px;">
                                            <div class="zoomWrapperTitle" style="width: 100%; position: absolute; display: block;">
                                              
                                            </div>
                                            <div class="zoomWrapperImage" style="width: 100%; height: 300px;">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="zoomPreload" style="visibility: hidden; top: 193.5px; left: 170px; position: absolute;">
                                        Loading zoom
                                    </div>
                                </div>
                            
                        </div>
                        <br>
                        <div class="goods-small-pic clearfix">
                            <ul id="thumblist" class="clearfix">
                            	@foreach($tp as $v)
                                <li style="width: 120px;height: 120px">
                                    <a href="javascript:void(0);" rel="">
                                        <img class="btn" src="{{$v->gpic}}" style="width: 100%;height: 100%">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <dl class="goods-info-box">
                        <dt class="goods-info-head">
                            <dl>
                                <dd>
                                    <strong>
                                        货　号：
                                    </strong>
                                    <span id="goods_item">
                                        {{$rs->id}}
                                    </span>
                                </dd>
                                <dd>
                                    <strong>
                                        店铺价：
                                    </strong>
                                    <span style="color: #ED145B;font-size: 20px;font-weight:bold;" id="goods_price">
                                        ￥{{$rs->gprice}}&nbsp;元
                                    </span>
                                </dd>
                                <dd class="group_price" style="display: none;">
                                    <strong>
                                        会员价：
                                    </strong>
                                    <span class="group_price" id="group_price_str">
                                    </span>
                                </dd>
                                <dd>
                                    <strong>
                                        库　存：
                                    </strong>
                                    <span id="goods_stock_show">
                                        {{$rs->gtock}}
                                    </span>
                                </dd>
                                <dd style="margin-bottom: 8px;">
                                    <strong>
                                        评　分：
                                    </strong>
                                    <span data-class="icon-stat-5" class="icon-stat icon-stat-5 J_mi_goods_starNum">
                                    </span>
                                    <span id="goods_comment_num">
                                        &nbsp;
                                        <a href="#goodsComment">
                                            1篇口碑报告
                                        </a>
                                    </span>
                                    
                                </dd>
                                  <dd>
                                    <strong>
                                        大小：
                                    </strong>
                                    <span id="goods_item">
                                        {{$rs->size}}
                                    </span>
                                </dd> 
                                <dd>
                                    <strong>
                                        型号：
                                    </strong>
                                    <span id="goods_item">
                                        {{$rs->xinghao}}
                                    </span>
                                </dd>

                                <dd id="goodsDetailBtnBox" class="goods-info-head-cart">
                                    <div style="margin-bottom:8px;">
                                        我想买：
                                        <button class="btn btn-primary" id="add_down" style="cursor: pointer;height: 30px;line-height: 30px;"
                                        type="button">
                                            -
                                        </button>
                                        <input type="text" style="width:25px;margin-bottom:2px;" name="buy_goods_num"
                                        id="buy_goods_num" value="1">
                                        <button class="btn btn-primary" id="add_up" style="cursor: pointer; pointer;height: 30px;line-height: 30px;"
                                        type="button">
                                            +
                                        </button>
                                        <label for="buy_goods_num" generated="true" class="error" style="display: inline-block;">
                                        </label>
                                    </div>
                                    
                                    
                                    <button type="button" title="收藏商品" onclick="addcart({{$rs->id}})" class="btn btn-primary goods-add-cart-btn">
                                        <!-- <i class="iconfont ">
                                            ❤
                                        </i> -->
                                        <i class="iconfont">
                                            +加入购物车
                                        </i>
                                    </button>
                                    <button type="button" onclick='add_fav({{$rs->id}})' title="收藏商品" gid="{{$rs->id}}" id='add_balance' class="btn btn-dake  goods-collect-btn">
                                        <i class="iconfont ">
                                            ❤
                                        </i>
                                        <i class="iconfont">
                                            收藏
                                        </i>
                                    </button>
                                    &nbsp;
                                    <img alt="手机扫描后，在手机中访问该商品" title="手机扫描后，在手机中访问该商品" width="60px" src="/img/6.png">
                                </dd>
                                <dd>
                                   
                                    <span id="ajax_order_count">
                                        {{$rs->gnum}}
                                    </span>
                                    人已经购买
                                </dd>
                            </dl>
                        </dt>
                    </dl>
                </div>
            </div>
            <div class="span5">
                <div style="border: 1px solid #ed6343;">
                    <div style="background-color: #ed6343;padding: 5px;color: #fff;">
                        <strong>
                            &nbsp;DBShop电子商务系统&nbsp;品质保证
                        </strong>
                    </div>
                    <div style="min-height:50px; font-size: 13px; padding: 8px;">
                        本店所售商品，货真价实，绝无次品，各位新老客户可放心购买！
                        <br>
                        可在后台 系统设置-&gt;内容信息 中进行设置
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row goods-detail-desc">
        <!--S left side-->
        <div class="span5">
            <div class="xm-box goods-alsobuy xm-goods-side-list">
                <div class="box-hd">
                    <div class="title">
                        相关商品
                    </div>
                </div>
                <div class="box-bd" style="width: 100%">
                    
                    @php
                     use App\Model\Admin\img;
                        use  App\Model\Admin\Goods;
                        $xg = Goods::where('tid','=',$rs->tid)->paginate(10);
                    @endphp
                    <ul>
                        @foreach($xg as $v)
                        <li>
                            <a title="{{$v->gname}}" href="/goods/gxq/{{$v->id}}">
                                <h2>
                                    {{$v->gname}}
                                </h2>
                                <h2 style="color: #ed6343;font-weight: bold;">
                                    ￥{{$v->gprice}}&nbsp;元
                                </h2>
                                <div class="star">
                                    &nbsp;
                                </div>
                                @php
                                    $p = img::where('gid',$v->id)->first();
                                    
                                @endphp
                                <img alt="{{$v->gname}}" src="{{$p->gpic}}"
                                class="leftImg">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        
        </div>
        <!--E left side-->
        <div class="span15">
            <div id="goodsDetail" class="xm-box  goods-detail-box ">
                <div class="box-hd" id="sticky_navigation">
                    <ul class="items clearfix J_pro_related_btns">
                     
                        <li>
                            <a href="#goodsComment">
                                商品评价
                            </a>
                        </li>
                        <li>
                            <a href="#goodsFaq" style="width: 100%">
                                商品介绍
                            </a>
                        </li>
                        <li>
                            <a href="#serQue">
                                售后服务
                            </a>
                        </li>
                        <li>
                            <a href="#goodsBuyQue">
                                规格包装
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="goodsDesc" class="box-bd edit_table_css">
                </div>
            </div>
            <!--E 规格-->
            <!--S 商品评论 -->
            <div id="goodsComment" class="xm-box goods-detail-comment ">
                <div class="box-hd">
                    <div class="title" >
                        商品评价
                    </div>
                </div>

                <div id="J_goods_detail_comment" class="box-bd">
                    <div class="com-body" id="list_goodscomment">
                        <ul class="content pin">
                            @php

                                use  App\Model\Home\discuss;
                                use  App\Model\Home\user;
                                $h = discuss::where('gid','=',$rs->id)->orderBy('addtime', 'desc')->get();
                                

                            @endphp
                            @foreach($h as $v)
                                @if($v->status == '1')
                            <li class="sut" ">
                                <div class="article">
                                    <h3 class="art_star clearfix">
                                        <div class="leftPart">
                                            <span class="icon-stat icon-stat-5">
                                            </span>
                                        </div>
                                        <div class="rightPart">
                                            {{date('Y-m-d H:i:s',$v->addtime)}}
                                        </div>
                                    </h3>
                                    <div class="art_content">
                                        {{$v->content}}
                                    </div>
                                    <div class="art_info clearfix ">
                                        &nbsp;
                                    </div>
                                 </div>
                                 <br>
                                 <br>
                                 <a class="buu"  xxoo="{{$v->id}}" href="avascript:void(0);" >回复</a>
                                    <div style="display: none;" class="su{{$v->id}}">
                                        <br><br>

                          
                                        
                                        <textarea gid="{{$v->gid}}"  una="{{$v->uid}}" class="ne{{$v->id}}" rows="6" style="width: 100%"></textarea>
                                           <input type="hidden" name="_token" value="Mz6HcWtB7p7tLQB0xT0nxNdusWFgeqMk9rcBtdnC"> 
                                        <br><br>
                                        <button class="hf" style="width: 100px;height: 30px;margin-left: 40%">回复</button>
                                    </div>
                               
                                <div class="head_photo">
                                    @php
                                        $y = user::where('id',$v->uid)->first();
                                                
                                    @endphp
                                    <img alt="99" src="{{$y->profile}}">
                                    <h3 class="name">
                                        
                                        {{$y->uname}}
                                    </h3>

                                </div>
                                <br>
                                <br>
                             
                            </li>

                            @endif
                            @endforeach
                             </ul>
                            <br><br>

                          
                                
                                <textarea name="{{$rs->id}}" class="form-control" rows="6" style="width: 100%"></textarea>
                                    <input type="hidden" name="_token" value="Mz6HcWtB7p7tLQB0xT0nxNdusWFgeqMk9rcBtdnC">
                                <br><br>
                                <button id="ppx" style="width: 100px;height: 30px;margin-left: 40%">评论</button>
                         
                            <li>
                                <div class="xm-pagenavi" style="padding: 0;">
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
                            </li>
                       
                    </div>
                </div>
            </div>
            <!--E 商品评论 -->
            <!-- FAQ -->
            <hr>
            <div id="goodsFaq" class="xm-box goods-detail-faq" style="width: 100%">
                <div class="box-hd">
                    <div class="title">
                       详细信息
                    </div>
                </div>

                <div class="box-bd" >
               
               	   {!!$rs->gdescr!!}
                  
                </div>
            </div>
            <!-- FAQ END -->
            <!-- 常见问题 -->
            <div id="serQue" class="common-question">
                <div class="question-hd clearfix">
                    <div class="title_a">
                        售后服务
                    </div>
                </div>
                <div class="question-bd">
                    <p>
                      <div class="mc">
                    <div class="item-detail item-detail-copyright">
                                                <div class="serve-agree-bd">
    <dl>
                                                                
                
                <dt>
            <i class="goods"></i>
            <strong>厂家服务</strong>
        </dt>
        <dd>
                                                                            本产品全国联保，享受三包服务，质保期为：七天质保<br>
                                                                                                                                                                                </dd>

                        <dt>
            <i class="goods"></i>
            <strong>京东承诺</strong>
        </dt>
        <dd>
                            京东平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！<br>
                                        注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！
        </dd>
                                <dt>
            <i class="goods"></i><strong>
             正品行货             </strong>
        </dt>
                        <dd>京东商城向您保证所售商品均为正品行货，京东自营商品开具机打发票或电子发票。</dd>
                                                <dt><i class="unprofor"></i><strong>全国联保</strong></dt>
                <dd>
                    凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由京东联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。京东商城还为您提供具有竞争力的商品价格和<a href="//help.jd.com/help/question-892.html" target="_blank">运费政策</a>，请您放心购买！
                    <br><br>注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！
                </dd>
                                <dt><i class="no-worries"></i><strong>无忧退货</strong></dt>
        <dd class="no-worries-text">
            客户购买京东自营商品7日内（含7日，自客户收到商品之日起计算），在保证商品完好的前提下，可无理由退货。（部分商品除外，详情请见各商品细则）
        </dd>
            </dl>
</div>
                                                <div id="state">
                            <strong>权利声明：</strong><br>京东上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是京东重要的经营资源，未经许可，禁止非法转载使用。
                            <p><b>注：</b>本站商品信息均来自于合作方，其真实性、准确性和合法性由信息拥有者（合作方）负责。本站不提供任何保证，并不承担任何法律责任。</p>
                                                        <br>
                            <strong>价格说明：</strong><br>
                            <p><b>京东价：</b>京东价为商品的销售价，是您最终决定是否购买商品的依据。</p>
                            <p><b>划线价：</b>商品展示的划横线价格为参考价，并非原价，该价格可能是品牌专柜标价、商品吊牌价或由品牌供应商提供的正品零售价（如厂商指导价、建议零售价等）或该商品在京东平台上曾经展示过的销售价；由于地区、时间的差异性和市场行情波动，品牌专柜标价、商品吊牌价等可能会与您购物时展示的不一致，该价格仅供您参考。</p>
                            <p><b>折扣：</b>如无特殊说明，折扣指销售商在原价、或划线价（如品牌专柜标价、商品吊牌价、厂商指导价、厂商建议零售价）等某一价格基础上计算出的优惠比例或优惠金额；如有疑问，您可在购买前联系销售商进行咨询。</p>
                            <p><b>异常问题：</b>商品促销信息以商品详情页“促销”栏中的信息为准；商品的具体售价以订单结算页价格为准；如您发现活动商品售价或促销信息有异常，建议购买前先联系销售商咨询。</p>

                                            </div>
                </div>
            </div>
                       
                        </strong>
                        中进行设置
                        <br>
                    </p>
                </div>
            </div>
            <div id="goodsBuyQue" class="common-question" style="margin-top: 30px;">
                <div class="question-hd clearfix">
                    <div class="title_a">
                        如何购买
                    </div>
                </div>
                <div class="question-bd">
                    <p>
                      
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

  @section('js')
	<script type="text/javascript">
		var se = $('.btn').attr('src');
		$('.goods-big-pic').attr('src',se);
		$('.btn').hover(function(){
			$('.goods-big-pic').attr('src',$(this).attr('src'));
		})
	
	</script>
     <script src='/fd/jquery-3.2.1.min.js'></script>
    <script src='/fd/hizoom.js'></script>
    <script>
        $('.hi1').hiZoom({
            width: 400,
            position: 'right'
        });
        $('.hi2').hiZoom({
            width: 400,
            position: 'left'
        });
    </script>
<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>

    <script type="text/javascript">
        $('#ppx').click(function(){
          
          @if(!session('id'))
          alert('没登录');
          window.location.replace("/home/user/login");
          return false;
          @endif
               var name = $('.form-control').val();
               var id = $('.form-control').attr('name');
               $.get('/pl',{'gid':id,'content':name},function(data){
                  $('.pin').prepend("<li> <div class='article'> <h3 class='art_star clearfix'> <div class='leftPart'> <span class='icon-stat icon-stat-5'> </span> </div> <div class='rightPart'> "+data.addtime+" </div> </h3> <div class='art_content'> "+data.content+" </div> <div class='art_info clearfix'> &nbsp;</div></div><br><br><a class='buu'  xxoo='{{$v->id}}' href='avascript:void(0);'>回复</a> <div style='display: none;' class='su{{$v->id}}'> <br><br> <textarea gid='{{$v->gid}}'  una='{{$v->uid}}' class='ne{{$v->id}}' rows='6' style='width: 100%'></textarea> <input type='hidden' name='_token' value='Mz6HcWtB7p7tLQB0xT0nxNdusWFgeqMk9rcBtdnC'> <br><br> <button class='hf' style='width: 100px;height: 30px;margin-left: 40%'>回复</button> </div> </div> </div> <div class='head_photo'> <img alt='99' src='"+data.img+"'> <h3 class='name'> "+data.uid+" </h3> </div> <br> <br> </li>");
                    // alert('评论成功');
                    $('.form-control').val('');
                    // window.location.reload();
                
               },'json')
           
        })
       

       
    </script>
    <script type="text/javascript">
      $('.buu').click(function(){
        window.location.reload();
        var id = $(this).attr('xxoo');
        $('.su'+id).show();
        $('.hf').click(function(){
            window.location.reload();
            var uid = $('.ne'+id).attr('una');
            var gid = $('.ne'+id).attr('gid');
           var st = $('.ne'+id).val();
            $.get('/hf',{'gid':gid,'content':st,'path':uid},function(data){
                if(data){
                    alert('成功');
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


                    alert('失败');

                }
            })
            
        })
      });
      //收藏
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

    //加入购物车
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


        ;

    </script>
   
  @stop
 