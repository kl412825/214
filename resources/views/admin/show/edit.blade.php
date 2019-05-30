@extends('common/admins')

@section('title',$title)

@section('content')

@if (count($errors) > 0)

     <div class="mws-form-message error">
          @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach  
     </div>
@endif
    <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>{{$title}}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/show/{{$rs->id}}" method="post" enctype='multipart/form-data'>
                            <div class="mws-form-row" style="width: 39%">
                                        <label class="mws-form-label">状态</label>
                                        <div class="mws-form-item">
                                            <select class="large" name="status">
                                                
                                                <option value="1" @if($rs->status == 1) checked @endif >显示</option>
                                                <option value="0" @if($rs->gstatus == 0) checked @endif>禁用</option>
                                            </select>
                                        </div>
                                    </div>
                    	    <div class="mws-form-row" >
                    <label class="mws-form-label">
                        网址
                    </label>
                    <div class="mws-form-item">
                        <input type="text" class="small" value="{{$rs->furl}}" name="furl" style="width:40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red">以http://www开头,com或者cn结束</span>
                    </div>
                </div>	
                    <img src="{{$rs->surl}}" style="width: 200px">
                    <div class="mws-form-row" style="width: 39%">
                        <label class="mws-form-label">轮播图</label>
                        <div class="mws-form-item">
                            <input type="file" name='surl' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>

               
                    			{{csrf_field()}}
                    		{{method_field('PUT')}}
                    	
                    		
                    		<div class="mws-button-row">
                    			<input type="submit" value="修改" class="btn btn-danger">
                    			
                    		</div>
                    		{{csrf_field()}}
                    	</form>
                    </div>  
    </div>  	
</div>
@stop