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
    <div class="mws-form-message success">
        {{session('success')}}
    </div>
    @endif
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <form action="/admin/user" method="get">
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
                    </label>
                </div>
         
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    用户名：
                    <input type="text" name="username" aria-controls="DataTables_Table_1" value="{{$request->username}}">
                </label>
                <label>
                    邮箱：
                    <input type="text" name="email" aria-controls="DataTables_Table_1" value="{{$request->email}}">
                </label>
                <button class="btn btn-info">搜索</button>
            </div>
            </form> 
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 30px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 60px;">
                            用户名
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 80px;">
                            邮箱
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 80px;">
                            手机号
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                            状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 30px;">
                            性别
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 40px;">
                            头像
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 110px;">
                            注册时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 150px;">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                	@foreach($rs as $k => $v)
                        @if($k%2== 0)
                            <tr class="odd">
                        @else
                            <tr class="even">
                        @endif
                    
                        <td class=" ">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                             {{$v->uname}}
                        </td>
                        <td class=" ">
                            {{$v->email}}
                        </td>
                        <td class=" ">
                            {{$v->phone}}
                        </td>
                        <td class=" " align="center">
                        	<a href="/admin/ustatus?id={{$v->id}}" style="color:#000;text-decoration:none;">
	                            @if($v->ustatus == 1)
	                                <span style="color:green">正常</span>
	                            @else
	                                <span style="color:red">禁用</span>
	                            @endif 
                        	</a>                          
                        </td>
                         <td class=" " align="center">
                            @if($v->sex == 1)
                                    男
                            @elseif($v->sex == 3)
                                    女
                            @else
                                    保密
                            @endif
                        </td>
                        <td class=" ">
                        	<img src="{{$v->profile}}" alt="">                            
                        </td>
                        <td class=" ">
                            {{date('Y-m-d H:i:s',$v->uaddtime)}}
                        </td>
                        <td class=" ">
                        	
                            <a href="/admin/user/{{$v->id}}/edit" class="btn btn-info">修改</a>
                            <form action="/admin/user/{{$v->id}}" method="post" style="display:inline;" >
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-success">删除</button>
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
                显示&nbsp;&nbsp;{{$rs->firstItem()}}&nbsp;&nbsp;to&nbsp;&nbsp;{{$rs->lastItem()}}&nbsp;&nbsp;of&nbsp;&nbsp;{{$rs->count()}}&nbsp;&nbsp;条数据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一共{{$rs->total()}}条数据 

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
        $('.mws-form-message').slideUp(2000);
    },3000);
</script>


@stop