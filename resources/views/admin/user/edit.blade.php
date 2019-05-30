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
        <form class="mws-form" action="/admin/user/{{$rs->id}}" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        用户名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="uname" value="{{$rs->uname}}" style="width:300px;" disabled>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        手机号
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="phone" value="{{$rs->phone}}" style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        邮箱
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="email" value="{{$rs->email}}" style="width:300px">
                    </div>
                </div>
                              
                <div class="mws-form-row">
				    <label class="mws-form-label" >
				       头像
				    </label>
				    <div class="mws-form-item" style="width:200px;">				  <img src="{{$rs->profile}}"  alt="" style="width:120px;">      
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
                                  	<input type="radio" name="ustatus" value="1" @if($rs->ustatus==1)
                                  	checked @endif >                           
                                    正常
                                </label>
                            </li>
                            <li>
                                <label>
                                	<input type="radio" name="ustatus" value="0" @if($rs->ustatus==0)
                                  	checked @endif> 禁用
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
            	{{csrf_field()}}
            	{{method_field('PUT')}}
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