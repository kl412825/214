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
    @if(session('success'))
    <div class="mws-form-message error">
        {{session('success')}}
    </div>
    @endif
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/doroleper?rid={{$res->id}}" method="post" >
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        角色名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="rolename" value="{{$res->rolename}}"  disabled style="width:300px">
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">权限名</label>
    				<div class="mws-form-item clearfix">
    					
    					<ul class="mws-form-list inline" style="width:780px;border:1px solid #000;padding:5px">
    						<li style="width:766px;border:1px solid #000;padding:3px"><input type="button" value="全选" onclick="quan()" style="width:50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="全不选" onclick="bu()" style="width:50px"></li>
    						@foreach($pers as $k => $v)
    							@if(($k+1)%5==0)
    								@if(in_array($v->id,$arr))	
		    							<li style="width:140px;border:1px solid #000;padding:3px"><label><input type="checkbox" value="{{$v->id}}" name="perid[]"  checked> {{$v->pername}}</label></li><br/>
		    						@else
		    							<li style="width:140px;border:1px solid #000;padding:3px"><label style="border:1px;"><input type="checkbox" value="{{$v->id}}" name="perid[]" > {{$v->pername}}</label></li><br/>
		    						@endif
    							@else	
	    							@if(in_array($v->id,$arr))	
		    							<li style="width:140px;border:1px solid #000;padding:3px"><label><input type="checkbox" value="{{$v->id}}" name="perid[]"  checked> {{$v->pername}}</label></li>
		    						@else
		    							<li style="width:140px;border:1px solid #000;padding:3px"><label><input type="checkbox" value="{{$v->id}}" name="perid[]" > {{$v->pername}}</label></li>
		    						@endif
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
<script>
function quan(){
	$('input:checkbox').prop('checked',true);
}
function bu(){
	$('input:checkbox').prop('checked',false);
}

</script>

@stop