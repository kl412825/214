@extends('home/self')
@section('name', '账户信息')
@section('gai')
	<div class="span16">
    <div class="xm-line-box uc-box uc-order-detail-box"><br><br>
        <div class="box-hd">
            <h3 class="title">
                账户信息
            </h3>
            
        </div>
        <div class="box-bd">
            <div class="message_one">
            </div>
            <form class="form-horizontal" action="/home/userinfo/update" enctype="multipart/form-data" method="post"
            name="user_edit_form" id="user_edit_form">
            {{ csrf_field() }}
                <div class="control-group">

                    <label class="control-label">
                        头像：
                    </label>
                    <div class="controls">
                        <img width="250px" src="{{$rs->profile}}">
                        <input type="hidden" name="old_img" id="old_user_avatar" value="{{$rs->profile}}">
                        <input type="file" name="img" id="img">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">
                        用户名称：
                    </label>
                    <div class="controls">
                        <input type="text" class="span5" id="name" value="{{$rs->uname}}" readonly="readonly"
                        name="name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">
                        会员分组：
                    </label>
                    <div class="controls">
                        <strong>
                            {{$rs->uauth}}
                        </strong>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">
                        电子邮箱
                        <span class="must_add_value">
                            *
                        </span>
                        ：
                    </label>
                    <div class="controls">
                        <input type="text" class="span5" id="email" value="{{$rs->email}}"
                        name="email">&nbsp;&nbsp;&nbsp;<span></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="input01" class="control-label">
                        性别
                        <span class="must_add_value">
                            *
                        </span>
                        ：
                    </label>
                    <div class="controls">
                        <select id="user_sex" name="sex" class="span2">
                            <option value="3" @if($rs->sex=='3') selected @endif >
                                保密
                            </option>
                            <option value="1" @if($rs->sex=='1') selected @endif >
                                男
                            </option>
                            <option value="2" @if($rs->sex=='2') selected @endif >
                                女
                            </option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="input01" class="control-label">
                        手机号码 ：
                    </label>
                    <div class="controls">
                        <input type="text" id="user_phone" name="phone" value="{{$rs->phone}}" class="span3">&nbsp;&nbsp;&nbsp;<span></span>
                    </div>
                </div>
                
                <div class="offset3">
                    <button onclick="return zgogo()"   class="btn btn-primary" >
                        保存修改
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	
	var phone = $('#user_phone').val();
	var email = $('#email').val();
	var pgo=null;
	var ego=null;

	function gogo(){
		var path = $("#img").val();
        if (path.length == 0) {
            
        } else {
            var extStart = path.lastIndexOf('.'),
                ext = path.substring(extStart, path.length).toUpperCase();
            if (ext !== '.PNG' && ext !== '.JPG' && ext !== '.JPEG' && ext !== '.GIF') {
                alert("上传文件类型不对");
                return false;
            }



        //判断
        }

        phoneo();


        

	    if(pgo==0){
	        return false;
	    }
		emailo();
	
	    if(ego==0){
	        return false;
	    }
	    
	    

	   
       
    }

   //手机
  
    function phoneo()
    {
        var zj = $('#user_phone');
        var str = zj.val();      
        var ret = /^1(3|4|5|7|8)\d{9}$/;

        if(ret.test(str)){
        	$.ajaxSettings.async = false;
            $.post('/home/user/uname',{'phone':str,'_token':'{{csrf_token()}}'},function(data){
               if(data==1){
               		if(str==phone){
               			pgo = 1;
               		}else{
               			zj.next().html('<font class="font">*手机号已被注册</font>');
                    	pgo = 0;
               		}
                    
               }else{
                    zj.next().html('<font class="gogo">*正确</font>');
                    pgo = 0;
               }
            })
            $.ajaxSettings.async = true;
                       
        }else{
            zj.next().html('<font class="font">*请输正确手机号</font>');
            pgo = 0;
        }
        
    }
    //
    function emailo()
    {
        var zj = $('#email');
        var str = zj.val();      
        var ret = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if(ret.test(str)){
        	$.ajaxSettings.async = false;
            $.post('/home/user/uname',{'email':str,'_token':'{{csrf_token()}}'},function(data){
               if(data==1){
               		if(str==email){
               			ego = 1;
               		}else{
               			zj.next().html('<font class="gogo">*电子邮箱已绑定</font>');
                    	ego = 0;
               		}                   
               }else{
                    zj.next().html('<font class="font">*电子邮箱可以使用</font>');                   
                    ego = 1;
               }
            })
            $.ajaxSettings.async = true;
                       
        }else{
            zj.next().html('<font class="font">*请输正确邮箱格式</font>');
            ego = 0;
        }
        
    }
    function zgogo(){
    	phoneo();
		emailo();
		return gogo();
    }
</script>
@stop