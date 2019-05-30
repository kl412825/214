@extends('common/admins')


@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    
    @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif
    

    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
			
			<form action="/admin/good" method='get'>
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="10" @if($request->num == '10') selected="selected" @endif >
	                            10
	                        </option>
	                        <option value="20" @if($request->num == '20') selected="selected" @endif>
	                            20
	                        </option>
	                        <option value="30" @if($request->num == '30') selected="selected" @endif>
	                            30
	                        </option>
	                        
	                    </select>
	                    条数据
	                </label>
	            </div>
	            <div class="dataTables_filter" id="DataTables_Table_1_filter">
	            	<label>
	                    商品名:
	                    <input type="text" name='gname' aria-controls="DataTables_Table_1" value="{{$request->gname}}">
	                </label>
	                <label>
	                    价格:
	                    <input type="text" name='price' aria-controls="DataTables_Table_1" value="{{$request->price}}">
	                </label>

	                <button class='btn btn-info'>搜索</button>
	            </div>
            </form>



            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width:20px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width:250px;">
                            商品名
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width:50px;">
                            尺寸
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width:150px;">
                            厂家
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width:50px;">
                           价格
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width:50px;">
                           库存
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width:60px;">
                           状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                           操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($rs as $k => $v)
                	@if($k % 2 == 0)
 						<tr class="odd">
                	@else
 						<tr class="even">
						
                	@endif
                  
                        <td class="">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->gname}}
                        </td>
                        <td class=" ">
                            {{$v->size}}
                            
                        </td>
                        <td class=" ">
                            {{$v->gcompany}}
                            
                        </td>
                         <td class=" ">
                            {{$v->gprice}}
                            
                        </td>
                        <td class=" ">
                            {{$v->gtock}}
                            
                        </td>

                       <!--  <td class=" ">
                           {!!$v->content!!}
                           
                       </td> -->
                       
                        <td class=" ">
                            @php
                                $arr=['关闭','开启'];
                            @endphp
                            <a href="/admin/goods/{{$v->id}}" class='btn'>{{$arr[$v->gstatus]}}</a>
                        </td>
                        <td class=" ">
                            <a class='btn btn-warning' href="/admin/xq/{{$v->id}}">详情</a>
                            <a class='btn btn-info' href="/admin/good/{{$v->id}}/edit">修改</a>
                            <form action="/admin/good/{{$v->id}}" method='post' style='display: inline'>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class='btn btn-success'>删除</button>
                            </form>
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
					    outline: none;
					    background-color: #444444;
					   
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

            <div class="dataTables_info" id="DataTables_Table_1_info">
                显示 {{$rs->firstItem()}} to {{$rs->lastItem()}} of {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据
                <!-- 每页显示几条数据 -->
                {{--$rs->count()--}}
                <!-- 显示当前的页码 -->
                {{--$rs->currentPage()--}}
                <!-- 显示当前页的数据从哪开始 -->
                {{--$rs->firstItem()--}}
                <!-- 返回的是boolean -->
                {{--$rs->hasMorePages()--}}
                <!-- 显示当前页的数据结束 -->
                {{--$rs->lastItem()--}}
                <!-- 显示的最后的页码 -->
                {{--$rs->lastPage()--}}
                <!-- 显示的是下一页的url地址 http://myapp.cn/admin/user?page=2 -->
                {{--$rs->nextPageUrl()--}}
                <!-- 显示的是每页的数据有多少条 -->
                {{--$rs->perPage()--}}
                <!-- 显示的是上一页的url地址 http://myapp.cn/admin/user?page=1 -->
                {{--$rs->previousPageUrl()--}}
                
                <!-- 显示的总条数 -->
                {{--$rs->total()--}}
                
                <!-- 根据参数获取分页的url地址 -->
                {{--$rs->url(4)--}}

            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
				{{$rs->appends($request->all())->links()}}
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
  <script>
      
    setTimeout(function(){

        $('.mws-form-message').hide(1200)
    },2000)  
  </script>
 


@stop