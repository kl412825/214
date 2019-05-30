@extends('common/public')

@section('title',$title)
<style type="text/css">
    #j_nav-category-section{
        display: block;
    }
</style>


    
@section('content')
        <div class="container">
            <div class="row">
                <div class="col col-16 offset4">
                    <div class="home-slider">
                        <div class="xm-slider">
                            <div class="xm-slider-container">
                                <div class="flexslider">
                                    <ul class="slides">
                                        @foreach($sh as $v)
                                            @if($v->status == 1)
                                        <li>
                                            <a target="" href="{{$v->furl}}">
                                                <img src="{{$v->surl}}">
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="home-hd-show container">
                        @php
                        $a=0;
                        @endphp
                       @foreach($sh as $v)
                       
                        @if($v->status == 1 && $a < 4)
                        
                        <div class="hd-show-item hd-show-item-first">
                            <a target="{{$v->furl}}" href="">
                                <img src="{{$v->surl}}" border='0'
                                />
                            </a>
                        </div>
                        @php
                        $a++;
                        @endphp
                         @endif
                        @endforeach
                   
                    </div>
                </div>
            </div>
            <!-- 商品 -->
            @php
            
            $meman = DB::table('management')->where('pid','0')->where('status','0')->orderBy('pow','asc')->get();
       
            @endphp
             @foreach($meman as $v)
            <div id="floor_{{$v->pow}}" class="container row has-floor index_goods_list">
                <div class="col col-4 goods-left">
                    <div>
                        <div class="heading">
                            <h4 class="title">
                                {{$v->pow}}F / {{$v->name}}
                            </h4>
                        </div>
                        <div class="drop-product">
                            <a target="_blank" href="">
                                <img src="/uploads/{{$v->img}}" border='0'
                                />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col col-16 goods-right">
                    @php
            
                    $mema1 = DB::table('management')->where('pid',$v->id)->where('status','0')->get();
       
                    @endphp
                    @foreach($mema1 as $v1)
                    @php
            
                        $txgoods = DB::table('goods')->find($v1->gid);
                       
                        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
                        if($txgoods->gstatus ==00){
                            continue;
                        }
        
                    @endphp
                    <div class="index-goods-item">
                        <div class="product-block">
                            <div class="image">
                                <div class="product-img">
                                    <a href="/goods/gxq/{{$txgoods->id}}" title="{{$txgoods->gname}}">
                                        <img class="img-responsive" src="{{$mig->gpic}}">
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="info">
                                    <h5 class="name">
                                        <a href="/DBShop/goods/8/2" title="{{$txgoods->gname}}">
                                            {{$txgoods->gname}}
                                        </a>
                                    </h5>
                                    <div class="price">
                                        <span class="price-new">
                                            ￥{{$txgoods->gprice}}.00&nbsp;元
                                        </span>
                                    </div>
                                </div>
                                <div id="opacity-cart" class="cart">
                                    <div class="cart-style">
                                        <button onclick="addcart({{$txgoods->id}});" class="add-to-cart cart-1-8" type="button">
                                            <i class="iconfont">
                                                +
                                            </i>
                                            <span>
                                                加入购物车
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div>
                    <a target="_blank" href="">
                        <img src="static/picture/23936116e1fdf6c7bfef9082c5814ed0.jpg" border='0'
                        />
                    </a>
                </div>
            </div>
            @endforeach
            

            <div class="floors">
                
                @foreach($meman as $v)
                <a class="floor" href="#floor_{{$v->pow}}">
                    <span class="floor_id">
                        {{$v->pow}}F
                    </span>
                    <span class="floor_title">
                         {{$v->name}}
                    </span>
                </a>  
                @endforeach              
            </div>
        </div>
        <script>

            $(window).load(function() {
                
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    slideshowSpeed: 4000
                });
            });
            $("#J_categoryContainer li").hover(function() {
                $(this).addClass("current");
            },
            function() {
                $(this).removeClass("current");
            });

            function add_cart(floor_num, goods_id, class_id) {
                $.post("/DBShop/cart/getAddCartInfo", {
                    goods_id: goods_id,
                    class_id: class_id
                },
                function(data) {
                    if (data != '') {
                        $.post("/DBShop/cart/addCart", {
                            goods_id: data.goods_id,
                            class_id: data.class_id,
                            buy_goods_num: 1,
                            select_color_value: data.select_color_value,
                            select_size_value: data.select_size_value,
                            selected_spec_tag_id_str: data.selected_spec_tag_id_str
                        },
                        function(datasta) {
                            if (datasta == 'true') {
                                $('.cart-' + floor_num + '-' + goods_id).html('已成功加入购物车');

                                var cart_goods_num = parseInt($('#top_cart').html()) + 1;
                                $('#top_cart').css('display', '');
                                $('#top_cart').html(cart_goods_num);

                                setTimeout(function() {
                                    $('.cart-' + floor_num + '-' + goods_id).html('<i class="iconfont"></i> <span>加入购物车</span>');
                                },
                                3000);
                                return true;
                            } else {
                                alert(datasta);
                            }
                        });
                    }
                },
                'json');
            }

            $(document).ready(function() {
                if ($(window).width() >= 768) {
                    var first_floor_element_offset = $('#floor_1').offset();
                    $('.floors').css('left', parseInt(first_floor_element_offset.left) - 50 + 'px');

                    $('.floors a').click(function(e) {
                        $('html, body').animate({
                            scrollTop: parseInt($($(this).attr('href')).offset().top) - 20
                        },
                        600);
                        return false;
                    });

                    $(window).scroll(function() {
                        var window_top = $(window).scrollTop();
                        $('.has-floor').each(function(i) {
                            var page_builder_wrapper_top = $(this).offset().top;

                            if (window_top > page_builder_wrapper_top - 300) {
                                $('.floors a:eq(' + i + ')').addClass('floor-active').siblings('a').removeClass('floor-active');
                            }
                        });
                    });
                } else {
                    $('.floors').css('display', 'none');
                }
            });
        </script>

        <!--[if lte IE 8]>
            <script>
                $("#dbshop-body").prepend('<p style="color:red;">您的浏览器版本有点低，对站点的某些视觉效果支持不是很好，您可以考虑去 升级浏览器版本 或者安装 <a href="http://rj.baidu.com/soft/detail/14744.html" target="_blank">Chrome</a> 、<a href="http://www.firefox.com.cn/" target="_blank">Firefox</a> 、<a href="http://www.baidu.com/s?wd=IE9" target="_blank">IE9或更高版本</a> 等其他浏览器!</p>');
            </script>
        <![endif]-->
        <style type="text/css">
            .go-top{position:fixed;width:40px;bottom:15%;right:0;z-index:890;} .go-top
            .go-top-box{width:100%;margin-bottom:3px;background:#d9d9d9;text-align:center;}
            .go-top .go-top-box a{display:block;height:35px;padding-top:5px;} .go-top
            .go-top-box a:hover{background:#777777;text-decoration:none;} .go-top .go-top-box
            a:hover .asid_title,.go-top .go-top-box .asid_title{color:#fff;font-size:12px;display:block;padding-left:6px;line-height:18px;width:30px;margin-top:-2px;}
        </style>
        <div class="go-top" id="go-top">
            <div class="go-top-box relative" style="display:none;">
                <a href="#">
                    <img alt="返回顶部" title="返回顶部" class="adid_icon" src="static/picture/icon_back.png">
                </a>
            </div>
        </div>
       <script type="text/javascript">
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
       </script>









           

        </script>
    </body>

</html>
@stop