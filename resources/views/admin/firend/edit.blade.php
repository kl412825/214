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
        <form class="mws-form" action="/admin/firend/{{$rs->id}}" method="post" >
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        网站名
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="fname" style="width:300px" value="{{$rs->fname}}">
                    </div>
                </div>      
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        网址
                    </label>
                    <div class="mws-form-item" >
                        <input type="text" class="small" name="furl" style="width:300px" value="{{$rs->furl}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:red">以http://www开头,com或者cn结束</span>
                    </div>
                </div>            
				<div class="mws-form-row">
                    <label class="mws-form-label">
                        状态
                    </label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                                <li><label><input type="radio" name='status' value='1' @if($rs->status==1)checked @endif> 开启</label></li>
                                <li><label><input type="radio" name='status' value='0' @if($rs->status==0)checked @endif> 禁用</label></li>
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