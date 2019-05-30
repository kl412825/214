<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title id='999'>{{ $rs }}</title>
	<h1 id='uname' style="display: none;">{{ $un }}</h1>
	<link rel="stylesheet" type="text/css" href="/home/tt/css/xcConfirm.css"/>
	<script src="/home/tt/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
	<script src="/home/tt/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	
</body>
</html>
<script type="text/javascript">
	setTimeout(function(){
		window.location.href="/home/user/login";
	},3000)
	var xo = $('#999').text();
	
	if(xo == 'yes'){
		var txt=  "注册成功,点击确认去登录";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.success);
		
	}else if(xo == 'sj'){
		var txt=  "置密码成功,您的账号为:"+$('#uname').text()+"马上去登录!";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.success);
	}else if(xo == 'nosj'){
		var txt=  "重置密码失败,再试一次吧!";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.error);
	}else{
		var txt=  "注册失败,请重新注册";
		window.wxc.xcConfirm(txt, window.wxc.xcConfirm.typeEnum.error);
	}

</script>