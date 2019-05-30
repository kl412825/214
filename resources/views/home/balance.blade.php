@extends('home/self')
@section('name', '我的收藏')
@section('gai')
	
	<div class="xm-line-box uc-box uc-favorite-box">
    <div class="box-hd">
        <h3 class="title">
            我的收藏
        </h3>
    </div>
    <div class="box-bd">
        <div class="xm-goods-list-wrap">
            <ul class="xm-goods-list clearfix">
            	@foreach($rs as $v)
            	@php
            		 	$txgoods = DB::table('goods')->find($v->gid);
                        $mig = DB::table('goodsimg')->where('gid',$txgoods->id)->first();
                @endphp

               		<li class="ood{{$v->id}}">
                    <div class="xm-goods-item">
                        <div class="item-thumb">
                            <a target="_blank" href="/goods/gxq/{{$txgoods->id}}">
                                <img src="{{$mig->gpic}}">
                            </a>
                        </div>
                        <div class="item-info">
                        </div>
                        <h3 class="item-title">
                            <a target="_blank" href="/goods/gxq/{{$txgoods->id}}">
                               {{$txgoods->gname}}
                            </a>
                        </h3>
                        <div class="item-price">
                            &nbsp;
                        </div>
                        <div class="item-star">
                            <span class="item-comments">
                                &nbsp;
                            </span>
                        </div>
                        <div class="item-actions">
                            <a  onclick="delb({{$v->id}})"
                            class="btn  btn-small btn-yellow J_delFav">
                                删除
                            </a>
                        </div>
                    </div>
                	</li>
                @endforeach 

            </ul>
            
        </div>
    </div>
</div>
<script type="text/javascript">
	function  delb(id){
		$.post('/home/user/del/balance',{'id':id,'_token':'{{csrf_token()}}'},function(data){
                swal({ 
                    title: "收藏", 
                    text: "删除收藏后无法恢复!", 
                    type: "warning",
                    showCancelButton: true, 
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "删除！", 
                    cancelButtonText: "取消",
                    closeOnConfirm: false, 
                    closeOnCancel: false    
                    },
                    function(isConfirm){ 
                    if (isConfirm) {
                       swal("成功", "删除收藏成功","success");
                       $('.ood'+id).remove();
                    } else { 
                        swal("取消", "取消操作","errors"); 
                    } 
    				});
            })
            
            
	}
</script>
@stop