@extends('common/admins')

@section('title',$title)

    <script type="text/javascript" src="/alert/sweetalert-dev.js"></script>
    <link rel="stylesheet" type="text/css" href="/alert/sweetalert.css">
@section('content')
@if(session('success'))
  <div class="mws-form-message error">
	{{session('success')}}
  	</div>
  @endif
 
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">

        	<form action="/admin/pl" post="get">
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="10" @if($request-> num =='10' ) selected="selected" @endif >
	                            10
	                        </option>
	                        <option value="20"
							@if($request-> num =='20' ) selected="selected" @endif 
	                        >
	                            20
	                        </option>
	                      <option value="30"
							@if($request-> num =='30' ) selected="selected" @endif 
	                      >
	                            30
	                        </option>
	                    </select>
	                    条数据
	                </label>
	            </div>

	            <div class="dataTables_filter" id="DataTables_Table_1_filter">
	                <label>
                        评论字:
                        <input type="text" name="search" aria-controls="DataTables_Table_1" value="{{$request->search}}">
                    </label>
	                  <button class="btn btn-primary">搜索</button>
	            </div>

            </form>

            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 100px;">
                            编号
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 180px;">
                           用户名
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 180px;">
                           商品名
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 180px;">
                           评论内容
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 180px;">
                           评论时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 100px;">
                            状态
                        </th>
               
        
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 134px;">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @php
                    use  App\Model\Admin\Goods;
                    use  App\Model\Admin\user;
                @endphp
                	@foreach($rs as $k=>$v)
                	@if($k % 2 == 0)
                    <tr class="odd">
                   @else
					<tr class="even">
				   @endif
                        <td >
                            {{$v->id}}
                        </td>
 
                        <td class=" ">

                             @php
                                $goo =user::where('id',$v->uid)->first();
                                if(!empty($goo)){
                               echo $goo->uname;
                            }
                            @endphp
                            
                        </td>
                        <td class=" ">
                            @php
                                $goo =Goods::where('id',$v->gid)->first();
                                if(!empty($goo)){
                               echo $goo->gname;
                            }
                            @endphp
                          
                          
                        </td>
                        <td class=" ">
                           {{$v->content}}
                              
                        </td>
                        <td class=" ">
                           {{date('Y-m-d H:i:s',$v->addtime)}}
                              
                        </td>
                        <td class=" ">
                            @php
                                $arr = ['禁言','显示'];
                            @endphp
                            <a href=""  gtt="{{$v->id}}" class="btn btn-success bbt"> {{$arr[$v->status]}}</a>
  
                        </td>

                        <td class=" ">
                        	<form action="/admin/pl/{{$v->id}}" method="post" style="display: inline;">
                           		<button  class="btn btn-success xu" >删除</button>
                           		{{ method_field('DELETE') }}
                           		{{csrf_field()}}
                           </form>
                          
                        </td>
                    </tr>
					@endforeach
                 
                   
                </tbody>
            </table>
            
            <div class="dataTables_info" id="DataTables_Table_1_info">
              显示 {{$rs->firstItem()}} to {{$rs->lastItem()}} of {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
            	<style type="text/css">
					.pagination{
						margin: 0px;
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
					    outline: none;
					    background-color: #444444;
					    color: #fff;
					    text-decoration: none;
					  
					    border-right: 1px solid rgba(0, 0, 0, 0.5);
					    border-left: 1px solid rgba(255, 255, 255, 0.15);
					   
			   
			    		box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
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

            	{{$rs->appends($request->all())->links()}}

               
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script type="text/javascript">
setTimeout(function(){
	$('.mws-form-message').hide('1200');
},2000);

$('.bbt').click(function(){
    var id = $(this).attr('gtt');
  
    $.get('/admin/pl/'+id,function(res){
        if(res == 1){
             swal("状态修改成功","有疑问请联系郑纯海")
             setTimeout("window.location.reload()" ,1500);
           
        }else{
          swal("失败","请联系郑纯海")
             setTimeout("window.location.reload()" ,1500);
        }
    })
    return false;
})





</script>

@stop