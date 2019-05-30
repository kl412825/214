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
                    	<form class="mws-form" action="/admin/type" method="post">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">类别名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="tname" class="small">
                    				</div>
                    			</div>

                    		<div class="mws-form-row" style="width:60%">
                    				<label class="mws-form-label" >父类</label>
                    				<div class="mws-form-item">
                    					<select class="large" name="pid" >
                    						<option value="0" >顶层分类</option>
                                                  @foreach($rs as $v)
                                                  @php

                                                       $nn = substr_count($v->path,',') -1;
                                                       
                                                     
                                                       $kong = str_repeat("&nbsp;",$nn*5);
                                                  @endphp
                    						<option @if($v->id == $id) selected @endif  value="{{$v->id}}" > {{$kong."|---".$v->tname}}</option>
                                                  @endforeach
                    						
                    						
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
                                <label><input type="radio" name='status' value='1' checked>
                                
                                    启用
                                </label>
                            </li>
                            <li>
                                <label><input type="radio" name='status' value='0'>
                                
                                    禁用
                                </label>
                            </li>
                           
                        </ul>
                    </div>
                </div>
               
                    			{{csrf_field()}}
                    		
                    	
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="添加" class="btn btn-danger">
                    			
                    		</div>
                    		{{csrf_field()}}
                    	</form>
                    </div>    	
                </div>
@stop