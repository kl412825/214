@extends('common.admins')

@section('title',$title)


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            {{$title}}
        </span>
    </div>
    @if (count($errors) > 0)
	    <div class="mws-form-message error">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	@if(session('error'))
    <div class="mws-form-message error">
        {{session('error')}}
    </div>
    @endif
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/user" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        用户名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="uname" style="width:300px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">用户名数字母下划线组成6-12位，必须以字母开头</span>
                    </div>
                </div>
                <div class="mws-form-row" >
                    <label class="mws-form-label">
                        密码
                    </label>
                    <div class="mws-form-item" >
                        <input type="password" class="small" name="password" id="pwd" style="width:300px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">字母数字和字符组成</span>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        确认密码
                    </label>
                    <div class="mws-form-item" >
                        <input type="password" class="small" name="repass" style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        手机号
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="phone" style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        邮箱
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="email" style="width:300px">
                    </div>
                </div>               
                <div class="mws-form-row">
				    <label class="mws-form-label" >
				       头像
				    </label>
				    <div class="mws-form-item" style="width:300px;">				    
				     <input type="file" name="profile" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">    
				    </div>
				</div>
				<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">性别</font></font></label>
    				<div class="mws-form-item">
    					<select class="large" name="sex">
    						<option value="1" ><font style="vertical-align: inherit;"   selected>男</font></option>
    						<option value="2"><font style="vertical-align: inherit;"  >女</font></option>
    						<option value="3"><font style="vertical-align: inherit; " >保密</font></option>
    						
    					</select>
    				</div>
    			</div>
				<div class="mws-form-row">
                    <label class="mws-form-label">
                        状态
                    </label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li>
                                <label>
                                  	<input type="radio" name="ustatus" value="1"  >                           
                                    正常
                                </label>
                            </li>
                            <li>
                                <label>
                                	<input type="radio" name="ustatus" value="0" checked> 禁用
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="mws-button-row">
            	{{csrf_field()}}
            	
                <input type="submit" value="添加" class="btn btn-info">               
            </div>
        </form>
    </div>
</div>
@stop


@section('js')

<script>
	setTimeout(function(){
		$('.mws-form-message').slideUp(2000);
	},3000);
</script>


@stop