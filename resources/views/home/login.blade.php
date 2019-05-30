@extends('common/public')
@section('title', '易星商场登录')
@section('content')
<link type="text/css" rel="stylesheet" href="/login/css/slide-unlock.css">

<style type="text/css">
	#oop1{
		display:none;
	}
</style>
<script type="text/javascript" src="/login/js/jquery.slideunlock.js"></script>


<link rel="stylesheet" type="text/css" href="/home/tt/css/xcConfirm.css"/>
<script src="/home/tt/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>

     <div class="container">
    <div class="xm-plain-box">
        <div class="box-hd">
            <h3 class="title">
                会员登录
            </h3>
        </div>
        <h1 id="success" style="display:none;">{{ $send or '蔡徐坤'}}</h1>
        <div class="box-bd">
            <div class="row">
                <form class="form-horizontal" method="post" action='/home/user/login/lo' name="login_form" id="login_form">
                	{{csrf_field()}}
                    <div class="control-group">
                        <div class="message_one">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            会员名称
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" id="user_name" placeholder="会员名称" name="uname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            会员密码
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="password" id="user_password" name="password" placeholder="输入会员密码">
                        </div>
                    </div>
                    <label for="input01" class="control-label">
                            验证码
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                    <div id="slider" style="margin-left:15%;margin-top:0%;">

				        <div id="slider_bg"></div>
				        <span id="label">>></span> <span id="labelTip">拖动滑块验证</span>
				    </div>
					<font id=''></font>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="login_security" value="ad74ec80a77fa79b452d312e8775ee89-b77dc26a985f66acfad671abe204c25a"
                            />
                            <input type="hidden" name="http_referer" value="http%3A%2F%2F127.0.0.1%2FDBShop%2Fuser%2Flogin"
                            />
                            <span class="btn btn-primary" type="submit" id='oop'>
                                会员登录
                            </span>
                            <button  class="btn btn-primary" type="submit" id='oop1'>
                                会员登录
                            </button >
                            &nbsp;&nbsp; &nbsp;&nbsp;
                            <button class="btn" type="button" onclick="location.href='/home/user/register'">
                                还不是会员，去注册会员
                            </button>
                            <p style="margin-top:10px;">
                                <a href="/home/user/forgotpasswd">
                                    会员忘记密码
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
	 if($('#success').text()==0){
	var txt= "账号或密码错误";
	window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.error);
	} else if($('#success').text()=='status'){
		var txt= "账号停封请联系管理员(qq10086:小马哥)";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.error);
	}
    //客户登录验证
    var yz;
    $(document).ready(function() {
        $("#login_form").validate({
            success: function(label) {
                label.addClass('validate_right').text('OK!');
            },
            rules: {
                user_name: {
                    required: true
                },
                user_password: {
                    required: true
                }
            },
            messages: {
                user_name: {
                    required: "请输入会员登录名称！"
                },
                user_password: {
                    required: "请输入密码！"
                },
            }
        });
    });
    $('#oop').click(function(){
    	
    		alert('请拖动验证码进行验证');
    	
    });

    //滑动验证码
   

    $(function () {
    var slider = new SliderUnlock("#slider",{
			successLabelTip : "验证成功"	
		},function(){
			$('#oop').remove();
			console.log($('#oop1').css('display','inline'));
			//$('#oop').html('<button class="btn btn-primary" type="submit">会员登录</button>');
			//以下四行设置恢复初始，不需要可以删除
			setTimeout(function(){
		        $("#labelTip").html("拖动滑块验证");
				$("#labelTip").css("color","#787878");
				},2000);

			//回位
			// slider.init();
		});
    slider.init();

    
})

    




   
    	
    // }
</script>
@endsection