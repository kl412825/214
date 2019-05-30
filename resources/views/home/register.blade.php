@extends('common/public')
@section('title', '易星商场注册')
@section('content')
<style type="text/css">
.bto{
        display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
        color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
}
a:hover{
    color:gray;
}
.font{
    color:red;
}
.gogo{
    color:#2bf666;
}
</style>
    <link rel="stylesheet" type="text/css" href="">
	<div class="container">
    <div class="xm-plain-box">
        <div class="box-hd">
            <h3 class="title">
                会员注册
            </h3>
        </div>
        <div class="box-bd">
            <div class="row">
                <form class="form-horizontal" method="post" action='/home/user/re'
                name="user_register_form" id="user_register_form">
                {{csrf_field()}}
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            会员名称
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" id="user_name" onblur="unameo()" placeholder="以字符开头6-12位数字字母" name="uname">&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
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
                            <input type="password" id="user_password" onblur="pwd1()" name="password" placeholder="6-18位数字字母">&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            确认密码
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="password" id="eciyanzheng" onblur="pwd2()" name="pwd" placeholder="输入确认密码">&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            手机号
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" id="user_phone" name="phone" onblur="phoneo()" placeholder="输入电子手机号">&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="input01" class="control-label">
                            验证码
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" class="input-small" id="yzm" onblur="yzmm()" name="yzm"
                            placeholder="输入验证码">
                            &nbsp;
                            <a id = 'send-yzm' class='bto'>获取验证码</a>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="register_security" value="89522ad6926201bc9328762f19d69758-b8d5524941f23935f5806616d8351b16"
                            />
                            <input type="hidden" name="http_referer" value="http%3A%2F%2F127.0.0.1%2FDBShop%2Fuser%2Fregister"
                            />
                            <button class="btn btn-primary" onclick='lesgo()' type="submit">
                                提交注册用户
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //用户名
    var mm =null;
    var min = 60 ;
    var kl = null;
    var rand = null;
    var phone;
    var yonghu;
    var shouji;
    function unameo()
    {
        var zj = $('#user_name')
        var str = zj.val();       
        var ret = /^[a-zA-Z][A-Za-z0-9_]{5,11}$/;

        if(ret.test(str)){
            $.post('/home/user/uname',{'uname':str,'_token':'{{csrf_token()}}'},function(data){
               if(data==1){
                    zj.next().html('<font class="font">*用户名已存在</font>');
                    yonghu = 0;
               }else{
                    zj.next().html('<font class="gogo">*正确</font>');
                    yonghu = 1;
               }
            })

            
            
        }else{
            zj.next().html('<font class="font">*请输正确的用户名格式</font>');
            yonghu = 0;
        }
        
    }
    //手机
    function phoneo()
    {
        var zj = $('#user_phone');
        var str = zj.val();      
        var ret = /^1(3|4|5|7|8)\d{9}$/;

        if(ret.test(str)){

            $.post('/home/user/uname',{'phone':str,'_token':'{{csrf_token()}}'},function(data){
               if(data==1){
                    zj.next().html('<font class="font">*手机号已被注册</font>');
                    shouji = 0;
               }else{
                    zj.next().html('<font class="gogo">*正确</font>');
                    phone = str;
                    shouji = 1;
               }
            })
            
                       
        }else{
            zj.next().html('<font class="font">*请输正确手机号</font>');
            return 0;
        }
        
    }
    //密码
    function pwd1()
    {
        var zj = $('#user_password');
        var str = zj.val();        
        var ret = /[A-Za-z0-9]{6,18}/;

        if(ret.test(str)){ 

            
            zj.next().html('<font class="gogo">*正确</font>');
            mm = str;
            return 1;
        }else{
            zj.next().html('<font class="font">*请输正确密码</font>');
            return 0;
        }
        
    }
    //二次密码验证
    function pwd2()
    {
        var zj = $('#eciyanzheng');
        str = zj.val();
        if(mm == null){
            zj.next().html('<font class="font">*请输入密码！</font>');
            return 0;
        }       
        if(str == mm){ 
            zj.next().html('<font class="gogo">*正确</font>');
            return 1;
        }else{
            zj.next().html('<font class="font">*两次密码不一致</font>');
            return 0;
        }
        
    }
    function yzmm(){
        var zj = $('#yzm');
        str = zj.val();
        if(str == rand && str!=null){ 
            zj.next().next().html('<font class="gogo">*正确</font>');
            return 1;
        }else{
            zj.next().next().html('<font class="font">*验证码不正确</font>');
            return 0;
        }  
    }
    $('#send-yzm').click(function(){
        if(shouji==1){
            $('#yzm').next().next().html('<font class="gogo">*信息已发送</font>');
            if(kl==null){
               rand = parseInt(Math.random()*(999999-111111+1)+111111,10);
                 $.post('/home/user/jhyzm',{'phone':phone,'yzm':rand,'_token':'{{csrf_token()}}'},function(data){
                       
                 })
                kl = setInterval('bao()',1000)
            }else{
                alert('请稍后再试');
            }
        }else{
            $('#yzm').next().next().html('<font class="font">*请先输入手机号</font>');
        }
        
    })
    function bao(){
        min = min-1;
        $('#send-yzm').text(min+'秒后可再次发送');
        if(min == 0){
            clearInterval(kl);//全局的
            min = 60;
            kl = null;
            $('#send-yzm').text('获取验证码');
        }
    }
    function lesgo(event){
        unameo()
        phoneo()
        pwd1()
        pwd2()
        yzmm()
        if( (yonghu==1) && (shouji==1) && (pwd1()==1) && (pwd2()==1) && (yzmm()==1)){
            
        }else{
             window.event.returnValue = false; 
        }
    }

</script>

@endsection