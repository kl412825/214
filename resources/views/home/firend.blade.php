@extends('common.public')

@section('title',$title)

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
                友情申请
            </h3>
        </div>
        <div class="box-bd">
            <div class="row">
                <form class="form-horizontal" method="post" action="/home/tianjia"
                 >{{csrf_field()}}
                    <div class="control-group">
                        <label for="input01" class="control-label">
                           网站名
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" id="fname"  placeholder="请输入网站名" name="fname">&nbsp;&nbsp;&nbsp;&nbsp;<span id="reg"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">
                            网址
                            <span class="must_add_value">
                                *
                            </span>
                            ：
                        </label>
                        <div class="controls">
                            <input type="text" id="furl"  name="furl" placeholder="请以http://开头，以com或者cn结束">&nbsp;&nbsp;&nbsp;&nbsp;<span id="regs"></span>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="controls">
                            
                            <button class="btn btn-primary" id="tj" type="submit">
                                提交申请
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
	
    //网站名
    $('#tj').click(function(){
    	
			if($('#fname').val()==''){
			$('#reg').html('<font class="font">*网站名不能为空</font>');
			return false;
    		
    		} 		
    });
 
    $('#tj').click(function(){	    		
    		if($('#furl').val()==''){
    			$('#regs').html('<font class="font">*网址不能为空</font>');
    			return false;
    		}else{
    			if(!/(http?):\/\/(www)\.([^\.\/]+)\.(com|cn)(\/[\w-\.\/\?\%\&\=]*)?/i.test($('#furl').val())){
    				$('#regs').html('<font class="font">*网址格式不正确</font>');
    				return false;
    			}
    		} 		
    });
       
   

</script>
@stop