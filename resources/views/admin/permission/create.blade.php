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
        <form class="mws-form" action="/admin/permission" method="post" >
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        权限名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="pername" style="width:300px">
                    </div>
                </div>   
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        权限路径 
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="perurl" style="width:300px">
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