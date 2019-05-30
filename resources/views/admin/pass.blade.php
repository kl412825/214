@extends('common.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            {{$title}}
        </span>
    </div>

   @if(count($errors) > 0)
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
        <form class="mws-form" action="/admin/dopass" method="post" >
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        旧密码
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="oldpass" style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row" >
                    <label class="mws-form-label">
                        新密码
                    </label>
                    <div class="mws-form-item" >
                        <input type="password" class="small" name="password" id="pwd" style="width:300px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">字母数字和字符组成</span>
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
            </div>
            <div class="mws-button-row">
            	{{csrf_field()}}
            	
                <input type="submit" value="修改" class="btn btn-info">               
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