@extends('common/admins')

@section('title','首页推荐管理')

@section('content')
<script src='/jquery.js'></script>
<!-- 弹窗js -->
<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>


<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            商品类别
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">

        	<form action="/home/management" post="get">
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
                            <option value="10" @if($request->num==10) 
                                selected="selected"
                                @endif >
                                10
                            </option>
                            <option value="20" @if($request->num==20) 
                                selected="selected"
                                @endif>
                                20
                            </option>
                            <option value="30" @if($request->num==30) 
                                selected="selected"
                                @endif>
                                30
                            </option>
                            <option value="40" @if($request->num==40) 
                                selected="selected"
                                @endif>
                                40
                            </option>
                        </select>
	                    条数据
                        <a style="margin-left: 500px" class='btn' href="/home/management/create" >添加</a>
	                </label>
	            </div>
	            <div class="dataTables_filter" id="DataTables_Table_1_filter">
	                <label>
	                    关键字:
	                    <input type="text" name="search" aria-controls="DataTables_Table_1" value="">
	                </label>
	                  <button class="btn btn-primary">搜索</button>
	            </div>

            </form>

            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                <thead>

                    <tr role="row">
                        <th  >
                            id
                        </th>
                        <th  s>
                            标题
                        </th>                        
                        <th  >
                            URL
                        </th> 
                        <th >
                            图片
                        </th> 
                        <th >
                            权重
                        </th> 
                        <th >
                            状态
                        </th>
                        <th >
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                	@foreach($arr as $v)
						<tr class="even  tr{{$v->id}}">
						    <td>
						        {{$v->id}}
						    </td>
						    <td >
						        {{$v->name}}
						    </td>
						    <td >
                               {{$v->id}} 
                            </td>
						    <td >
						      <img width='150px' src="/uploads/{{$v->img}}"> 
						    </td>
                             <td >
                              {{$v->pow}}
                            </td>
						    
						    <td class=" " align="center">
						        <a onclick="zt({{$v->id}})" id="{{$v->id}}"  class="btn  {{$v->status}}">@php echo $brr[$v->status] @endphp</a>
						    </td>
						    <td class=" ">
                                 <a href="/home/management/{{$v->id}}/edit" class="btn btn-info">
                                    添加商品
                                  </a>
                               
						        <a href="/home/management/{{$v->id}}" class="btn btn-warning">
						            修改
						        </a>
						       
						        
						            <button class="btn btn-success" onclick="del({{$v->id}})">
						                删除
						            </button>
						            
						    </td>
						</tr>             	                	                    
                   	@endforeach
					                						
					                 
                   
                </tbody>
            </table>
            
            
					

            	 <style>
                .pagination{

                    margin:0px;
                }

                .pagination li{
                        float: left;
                        height: 20px;
                        padding: 0 10px;
                        display: block;
                        font-size: 12px;
                        line-height: 20px;
                        text-align: center;
                        cursor: pointer;
                        
                        background-color: #444444;
                       
                        text-decoration: none;
                        border-right: 1px solid rgba(0, 0, 0, 0.5);
                        border-left: 1px solid rgba(255, 255, 255, 0.15);
                        box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                }
				#mws-footer{
					display:none;
				}
                .pagination a{
                     color: #fff;
                }

                .pagination .active{
                    
                    color: #323232;
                    border: none;
                    background-image: none;
                    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
                    background-color: #f08dcc;
                }

            </style>

            	<div class="dataTables_info" id="DataTables_Table_1_info">
                显示&nbsp;&nbsp;{{$arr->firstItem()}}&nbsp;&nbsp;to&nbsp;&nbsp;{{$arr->lastItem()}}&nbsp;&nbsp;of&nbsp;&nbsp;{{$arr->count()}}&nbsp;&nbsp;条数据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一共{{$arr->total()}}条数据 

            	</div>
            	<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                {{$arr->appends($request->all())->links()}}
                
            	</div>


               
            
        </div>
    </div>
</div>

<script type="text/javascript">
	function zt(id){
		var zt =$('#'+id).text();
		if(zt == '开启'){zt=0}else{zt=1}
		$.post('/home/management',{'_token':'{{csrf_token()}}','id':id,'status':zt},function(data){
			if(data!='0'){
				var brr=['开启','关闭']
				if(zt==0){zt=1}else{zt=0};
				$('#'+id).text(brr[zt]);
				$('#'+id).text(brr[zt]);
			}
		})
	}
   function del(id){
        swal({ 
        title: "确定删除吗？", 
        text: "删除后无法恢复!!!", 
        type: "warning",
        showCancelButton: true, 
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确定删除！", 
        cancelButtonText: "取消删除！",
        closeOnConfirm: false, 
        closeOnCancel: false    
        },
        function(isConfirm){ 
        if (isConfirm) {
            $.post('/admin/management/del',{'_token':'{{csrf_token()}}','id':id},function(date){
                $('.tr'+id).remove();
                console.log(date);
            }) 
            swal("删除！", "你的订单文件已经被删除!",
        "success"); 
        } else { 
            swal("取消！", "你已取消此删除((*^▽^*))",
        "error"); 
        } 
    });

    }

</script>
@stop