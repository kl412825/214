@extends('common/admins')
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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
                        <form class="mws-form" action="/admin/good/{{$res->id}}" method="post" enctype='multipart/form-data'>
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">商品名称</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="gname" value="{{$res->gname}}" class="small">
                                    </div>
                                </div>

                            <div class="mws-form-row" style="width:58%">
                                    <label class="mws-form-label" >类别</label>
                                    <div class="mws-form-item">
                                        <select class="large" name="tid" >
                                            <option value="0" >顶层分类</option>
                                                  @foreach($rs as $v)
                                                  @php

                                                       $nn = substr_count($v->path,',') -1;
                                                       
                                                     
                                                       $kong = str_repeat("&nbsp;",$nn*5);
                                                  @endphp
                                                    @if($res->tid == $v->id)
                                                    <option value='{{$v->id}}' selected>
                                                            {{$kong."|---".$v->tname}}
                                                    </option>
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
                                        <input type="text" value="{{$res->gcompany}}" name="gcompany" class="small">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">大小</label>
                                    <div class="mws-form-item">
                                        <input type="text" value="{{$res->size}}" name="size" class="small">
                                    </div>
                                </div>
                                    <div class="mws-form-row">
                                    <label class="mws-form-label">型号</label>
                                    <div class="mws-form-item">
                                        <input type="text" value="{{$res->xinghao}}" name="xinghao" class="small">
                                    </div>
                                </div>
                               
                                <div class="mws-form-row">
                                    <label class="mws-form-label">单价</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="gprice" value="{{$res->gprice}}" class="small">
                                    </div>
                                </div>
                            
                              
                                <div class="mws-form-row" style="width: 58%">
                                        <label class="mws-form-label">状态</font></label>
                                        <div class="mws-form-item">
                                            <select class="large" name="gstatus">
                                                
                                                <option value="1" @if($res->gstatus == 2) checked @endif>在售</option>
                                                <option value="0" @if($res->gstatus == 3) checked @endif>下架</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">库存量</label>
                                        <div class="mws-form-item">
                                        <input type="text" value="{{$res->gtock}}" name="gtock" class="small">
                                        </div>
                                    </div>
                                     <div class="mws-form-row" style="width: 58%">
                                    <label class="mws-form-label">简介</label>
                                    <div class="mws-form-item">
                                        <script name="gdescr" id="editor" type="text/plain" style="width:1024px;height:500px;">{!!$res->gdescr!!}</script>
                                    </div>
                                </div>
                                    <div class="mws-form-row" style="width: 58%">
                                    <label class="mws-form-label">商品图片</label>
                                    <div class="mws-form-item">
                                        @foreach($gs as $k => $v)
                                        <img gimgid = "{{$v->id}}" src="{{$v->gpic}}" class='imgs' alt="" style='width:130px'>
                                        @endforeach
                                            <input type="file" multiple name='gpic[]' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                                        </div>
                                </div>

                                {{csrf_field()}}
                            
                        
                            </div>
                            <div class="mws-button-row">
                                <input type="submit" value="修改" class="btn btn-danger">
                                
                            </div>
                            {{method_field('PUT')}}
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
       setTimeout(function(){
        // $('.mws-form-message').slideUp(2000);
        $('.mws-form-message').fadeOut(2000);

    },3000)

    // delay(3000).


    //商品图片的删除
    $('.imgs').click(function(){

        //获取图片的id号
        var gimgid = $(this).attr('gimgid');
   
        var gm = $(this);

        $.get('/admin/good/'+gimgid,{},function(data){

            if(data == 1){

                gm.remove();
            }
        })

    })

</script>
@stop