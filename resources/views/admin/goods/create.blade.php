@extends('common/admins')
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
@section('title',$title)

@section('content')

@if (count($errors) > 0)

     <div class="mws-form-message error" id="tb">
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
                    	<form class="mws-form" action="/admin/good" method="post" enctype='multipart/form-data'>
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">商品名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="gname" class="small">
                    				</div>
                    			</div>

                    		<div class="mws-form-row" style="width:58%">
                    				<label class="mws-form-label" >类别</label>
                    				<div class="mws-form-item">
                    					<select class="large" name="tid" >
                    						
                                                  @foreach($rs as $v)
                                                  @php

                                                       $nn = substr_count($v->path,',') -1;
                                                       
                                                     
                                                       $kong = str_repeat("&nbsp;",$nn*5);
                                                  @endphp
                                                  @if($v->pid ==0)
                                                    <option value="{{$v->id}}"  disabled> {{$kong."|---".$v->tname}}</option>
                                                  @else

                    						<option value="{{$v->id}}" > {{$kong."|---".$v->tname}}</option>
                                                @endif
                                                  @endforeach
                    						
                    						
                    					</select>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">生产厂家</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="gcompany" class="small">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">大小</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="size" class="small">
                                    </div>
                                </div>
                                    <div class="mws-form-row">
                                    <label class="mws-form-label">型号</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="xinghao" class="small">
                                    </div>
                                </div>
                               
                                <div class="mws-form-row">
                                    <label class="mws-form-label">单价</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="gprice" class="small">
                                    </div>
                                </div>
                                <div class="mws-form-row" style="width: 58%">
                                    <label class="mws-form-label">商品图片</label>
                                    <div class="mws-form-item">
                                            <input type="file" multiple name='gpic[]' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                                        </div>
                                </div>
                              
                                <div class="mws-form-row" style="width: 58%">
                                        <label class="mws-form-label">状态</font></label>
                                        <div class="mws-form-item">
                                            <select class="large" name="gstatus">
                                                
                                                <option value="1">在售</option>
                                                <option value="0">下架</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">库存量</label>
                                        <div class="mws-form-item">
                                        <input type="text" name="gtock" class="small">
                                        </div>
                                    </div>
                                     <div class="mws-form-row" style="width: 58%">
                                    <label class="mws-form-label">简介</label>
                                    <div class="mws-form-item">
                                        <script name="gdescr" id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
                                    </div>
                                </div>

                    			{{csrf_field()}}
                    		
                    	
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="添加" class="btn btn-info">
                    			
                    		</div>
                    		{{csrf_field()}}
                    	</form>
                    </div>    	
                </div>
@stop

@section('js')
<script type="text/javascript">
  //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
</script>
@stop
