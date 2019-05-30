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
        <form class="mws-form" action="/admin/dousersrole?id={{$us->id}}" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        用户名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="username" value="{{$us->username}}" disabled style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">角色</label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						@foreach($roles as $k => $v)

	    						@if(in_array($v->id,$urr))
	    							<li><label><input type="checkbox" value="{{$v->id}}" name="roleid[]" checked="checked"> {{$v->rolename}}</label></li>
	    						@else

	    							<li><label><input type="checkbox" value="{{$v->id}}" name="roleid[]" > {{$v->rolename}}</label></li>
	    						@endif

    						@endforeach
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