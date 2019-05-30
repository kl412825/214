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
                    	<form class="mws-form" action="/admin/type/{{$rs->id}}" method="post">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">类别名称</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="tname" class="small" value="{{$rs->tname}}">
                    				</div>
                    			</div>
                                    
                    @php
                        $info = DB::table('type')->where('id',$rs->pid)->first();
                       
                       if(!$info){
                            $info = $rs;
                        }
                    @endphp
                    <div class="mws-form-row">
                        <label class="mws-form-label">父级分类</label>
                        <div class="mws-form-item">
                            <input type="text" name='' class="small" value='{{$info->tname}}' disabled>
                        </div>
                    </div>

                                <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li>
                                <label><input @if($rs->status==1)checked @endif type="radio"  name='status' value='1' >
                                
                                    启用
                                </label>
                            </li>
                            <li>
                                <label><input @if($rs->status==0)checked @endif type="radio" name='status' value='0'>
                                
                                    禁用
                                </label>
                            </li>
                           
                        </ul>
                    </div>
                    	
                    			
               
                    			{{csrf_field()}}
                                {{method_field('PUT')}}
                    		
                    	
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="修改" class="btn btn-danger">
                    			
                    		</div>
                    		{{csrf_field()}}
                    	</form>
                    </div>    	
                </div>
@stop