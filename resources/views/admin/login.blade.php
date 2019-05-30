<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{$title}}</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="/adminlogin/css/login.css">
</head>
<body>
<!-- particles.js container -->
<div id="particles-js" style="display: flex;align-items: center;justify-content: center">
</div>
<div class="login-page">
    <form action="/admin/dologin" method="post">
       <div class="login-content">
         <div class="login-tit">登录</div>
         <div>
            @if(session('error'))
                <div class="mws-form-message error">
                     {{session('error')}}
                </div>
            @endif                
         
         <div class="login-input">
           <input type="text" name="uname" placeholder="请输入用户名">
         </div>
         <div class="login-input">
          <input type="password" name="password" placeholder="密码">
        </div>
         <div class="login-input">
          <input type="text" name="code" placeholder="验证码" style="width:250px" >
        <img src="/admin/captcha" alt="" style="border-radius:5px;cursor:pointer;width:100px" onclick='this.src = this.src+="?1"'>
        </div>
        <div class="login-btn">
          <div class="login-btn-left">
            {{csrf_field()}}
            <input type="submit" value="登录"  class="span" >
            
          </div>
          
        </div>
       </div>
   </div>
    </form>
</div>


<!-- scripts -->
<script src="/adminlogin/js/particles.js"></script>
<script src="/adminlogin/js/app.js"></script>
<script src="/admin/js/libs/jquery-3.2.1.min.js"></script>

</body>
</html>

<script>
    setTimeout(function(){
        $('.mws-form-message').slideUp(1000);
    },2000);
</script>

