@extends('common.admins')

@section('title',$title)


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            {{$title}}
        </span>
    </div>
    @if(session('error'))
    <div class="mws-form-message error">
        {{session('error')}}
    </div>
    @endif

    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/role" method="post" >
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        角色名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="rolename" style="width:300px">
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
                                  	<input type="radio" name="status" value="1" checked >                           
                                    开启
                                </label>
                            </li>
                            <li>
                                <label>
                                	<input type="radio" name="status" value="0" > 禁用
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