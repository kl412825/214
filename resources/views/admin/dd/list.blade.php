@extends('common/admins')
@section('title', '订单列表')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
		<link rel="stylesheet" type="text/css" href="/ad/dt/css/htmleaf-demo.css"><!--演示页面样式，使用时可以不引用-->
		<link rel="stylesheet" href="/ad/dt/node_modules/bootstrap/dist/css/bootstrap.min.css"/>
	  	<link rel="stylesheet" href="/ad/dt/node_modules/prismjs/themes/prism-tomorrow.css"/>
        
  <style type="text/css">

.cbp-vimenu {
    position: fixed;
    overflow: hidden;
    top:88;
    right: 0;
    list-style-type: none;
    margin: 0;
    padding: 0;
    background: #f7f7f7;
}
.cbp-vimenu li a {
    display: block;
    /*text-indent: -500em;*/
    height: 5em;
    width: 5em;
    line-height: 5em;
    text-align: center;
    position: relative;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    -webkit-transition: background 0.1s ease-in-out;
    -moz-transition: background 0.1s ease-in-out;
    transition: background 0.1s ease-in-out;
}
.container {
	width:90%;
}
.cbp-vimenu li a:hover{
    background: #47a3da;
    color:#FFF;

}
.cbp-vimenu li a{
    text-decoration: none;
}

        button {
            margin-bottom: 0.5em;
        }
        .container {
   	 max-width: 1500px;
	}
	h3{
		font-weight:200;
	}
	.mws-panel .mws-panel-header{
		height: 50px;
	}
    </style>
        <ul  class="cbp-vimenu">
            @if($request->od != null)
                <li><a href="/admin/Dd?od=j" >全部</a></li>
                <li><a href="/admin/Dd?ac=0&od=j" >未发货</a></li>
                <li><a href="/admin/Dd?ac=1&od=j" >已发货</a></li>
                <li><a href="/admin/Dd?ac=3&od=j" >未付款</a></li>
                <li><a href="/admin/Dd?ac=2&od=j" >已收货</a></li>
                <li><a href="/admin/Dd?ac=4&od=j" >失效</a></li>       
            @else
                <li><a href="/admin/Dd" >全部</a></li>
                <li><a href="/admin/Dd?ac=0" >未发货</a></li>
                <li><a href="/admin/Dd?ac=1" >已发货</a></li>
                <li><a href="/admin/Dd?ac=3" >未付款</a></li>
                <li><a href="/admin/Dd?ac=2" >已收货</a></li>
                <li><a href="/admin/Dd?ac=4" >失效</a></li>
            @endif
        </ul>
        <div class="mws-panel grid_8 mws-collapsible">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i>订单列表</span>
                    <div class="mws-collapse-button mws-inset"><span></span></div></div>

                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                 <form action="/admin/Dd" method="get">
                    @if($request->ac != null)

                        <input  type='hidden' name='ac' value="@php echo $_GET['ac'] @endphp">
                    @endif
                    @if($request->od != null)
                        <input  type='hidden' name='od' value="@php echo $_GET['od'] @endphp">
                    @endif
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
                    关键字：
                    <input type="text" name="keyword" aria-controls="DataTables_Table_1" value="{{$request->keyword}}">
                </label>
                <button class="btn btn-info">搜索</button>
            </div>
            </form> 
                         <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                	<th>id</th>
                                	<th>订单号</th>
                                	<th>商品</th>
                                	<th>数量</th>
                                	<th>实付款</th>
                                	<th>收货地址</th>
                                	<th>发货状态</th>
                                	<th>操作</th>
                                </tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($arr as $v)
                        	<tr class="odd {{ $v->id }}" >
                                    <td class="sorting_1">{{ $v->id }}</td>
                                    <td class=" ">{{ $v->dhao }}</td>
                                    <td class=" ">{{ $v->good }}</td>
                                    <td class=" ">{{ $v->onum }}</td>
                                    <td class=" ">{{ $v->ototal }}.00¥</td>
                                    <td class=" ">{{ $v->oaddress }}</td>
                                    <td class=" ">
                                    	@if ($v->ostatus == 0)
										    <span zt="0"class="badge badge-warning">未发货</span>
										@elseif($v->ostatus == 1)
										    <span zt="1" class="badge badge-info">已发货</span>
										@elseif($v->ostatus == 2)
										    <span zt="2" class="badge badge-info">已收货</span>
										@elseif($v->ostatus == 3)
										    <span zt="3" class="badge badge-info">未付款</span>
										@elseif($v->ostatus == 4)
										    <span zt='4'class="badge badge-error">无效订单</span>
										@endif
                                    	
                                    </td>
                                    <td class=" ">
                                        <span class="btn-group">
                                            <a href="#" class="btn btn-small" onclick="select({{ $v->id }})"><i class="icon-search"></i></a>
                                            <a href="#" class="btn btn-small" onclick="update({{ $v->id }})" > 
                                            	<i class="icon-pencil"></i></a>
                                            <a href="#" class="btn btn-small" onclick="del({{ $v->id }})"><i class="icon-trash"></i></a>
                                            <!-- <a href="/admin/Dd/{{ $v->id }}" class="btn btn-small" data-method="DELETE" ><i class="icon-trash"></i></a> -->
                                        </span>
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
            

@stop 
@section('js')
<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
<script>
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
    setTimeout(function(){
        $('.mws-form-message').slideUp(2000);
    },3000);
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
			$.post('/admin/del',{'_token':'{{csrf_token()}}','id':id},function(date){
				$('.'+id).remove();
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
<!-- <script src="/ad/dt/js/jquery-1.11.0.min.js" type="text/javascript"></script> -->
<script src="/ad/dt/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/ad/dt/js/bootstrap-show-modal.js"></script>
<!-- <script src="/ad/dt/node_modules/prismjs/prism.js"></script> -->
<script>
   function  update(id){
   		$.ajax({
   			url: '/admin/Dd/'+id+'/edit',
   			async :false,
   			type:'get',
   			dataType:'json',
   			success:function(date){

        $.showModal({
            title: '修改订单',
            body:
                '<form><div class="form-group row">' +
                '<div class="col-3"><label for="text" class="col-form-label">订单号</label></div>' +
                '<div class="col-9"><input type="text" value="'+date.dhao+'" class="form-control" id="dhao"/></div>' +
                '</div>' +
                '<div class="form-group row">' +
                '<div class="col-3"><label for="select" class="col-form-label">订单状态</label></div>' +
                '<div class="col-9"><select id="ostatus" class="form-control"><option checked value="999">默认</option>' +
                '<option value="0">未发货</option><option value="1">已发货</option><option value="2">已收货</option><option value="3">未付款</option><option value="4">无效订单</option>' +
                '</select></div>' +
                '</div>' +
                '<div class="form-group row">' +
                '<div class="col-3"><label for="textarea" class="col-form-label">购买数量</label></div>' +
                '<div class="col-9"><input type="text" value="'+date.onum+'" class="form-control" id="onum"/></textarea></div>' +
                '</div>'+
                '<div class="form-group row">' +
                '<div class="col-3"><label for="textarea" class="col-form-label">实付款</label></div>' +
                '<div class="col-9"><input type="text" value="'+date.ototal+'" class="form-control" id="ototal"/></textarea></div>' +
                '</div>'+
                '<div class="form-group row">' +
                '<div class="col-3"><label for="textarea" class="col-form-label">收货地址</label></div>' +
                '<div class="col-9"><input type="text" value="'+date.oaddress+'" class="form-control" id="oaddress"/></textarea></div>' +
                '</div>'+
                '<div class="form-group row">' +
                '<div class="col-3"><label for="textarea" class="col-form-label">收货人</label></div>' +
                '<div class="col-9"><input type="text" class="form-control" value="'+date.oname+'" id="oname"/></textarea></div>' +
                '</div>'+
                '<div class="form-group row">' +
                '<div class="col-3"><label for="textarea" class="col-form-label">快递单号</label></div>' +
                '<div class="col-9"><input type="text" value="'+date.kdd+'" class="form-control" id="kdd"/></textarea></div>' +
                '</div>'+
                '</form>',
            footer: '<button type="button" class="btn btn-link" data-dismiss="modal">取消</button><button type="submit" class="btn btn-primary">确定</button>',
            onCreate: function (modal) {
                $(modal.element).on("click", "button[type='submit']", function (event) {
                    event.preventDefault()
                    var $form = $(modal.element).find("form");
                           var arr = new Object();
                            arr.id = id;
                            arr.dhao = $form.find("#dhao").val();
                            arr.ostatus = $form.find("#ostatus").val();
                            arr.onum = $form.find("#onum").val();
                            arr.ototal = $form.find("#ototal").val();
                            arr.oaddress = $form.find("#oaddress").val();
                            arr.oname = $form.find("#oname").val();
                            arr.kdd = $form.find("#kdd").val();

                            if(arr.ostatus=='999'){
                            	arr.ostatus = $('.'+arr.id).children("td").eq(6).children().first().attr('zt');
                            }
                            console.log(arr);

                            //拿到数据
                   			// $.post('/admin/del',{'_token':'{{csrf_token()}}'},function(date){
                   			// 	console.log(date);
                   			// }
                   			gogo(arr);
                    modal.hide()
                })
            }
        })
        }
    })
   	}

function  select(id){
   		$.ajax({
   			url: '/admin/Dd/'+id+'/edit',
   			async :false,
   			type:'get',
   			dataType:'json',
   			success:function(data){
   				if(data.omsg==null){
   					data.omsg='卖家未留言';
   				}
   			var arr=['未发货','已发货','已收货','未付款','无效订单']
        $.showModal({
            title: '查询订单详情',
            body: '<table class="table table-bordered">'+
  				  '<tr><td>id</td><td>'+id+'</td></tr>'+
  				  '<tr><td>订单号</td><td>'+data.dhao+'</td></tr>'+
  				  '<tr><td>购买用户</td><td>'+data.uid+'</td></tr>'+
  				  '<tr><td>购买商品</td><td>'+data.good+'</td></tr>'+
  				  '<tr><td>收货人</td><td>'+data.oname+'</td></tr>'+
  				  '<tr><td>收货地址</td><td>'+data.oaddress+'</td></tr>'+
  				  '<tr><td>电话</td><td>'+data.ophone+'</td></tr>'+
  				  '<tr><td>购买数量</td><td>'+data.onum+'</td></tr>'+
  				  '<tr><td>下单时间</td><td>'+data.oaddtime+'</td></tr>'+
  				  '<tr><td>实付金额</td><td>'+data.ototal+'.00¥</td></tr>'+
  				  '<tr><td>卖家留言</td><td>'+data.omsg+'</td></tr>'+
                  '<tr><td>订单状态</td><td>'+arr[data.ostatus]+'</td></tr>'+
  				  '<tr><td>快递单号</td><td>'+data.kdd+'</td></tr>'+
				  '</table>',
                
            footer: '<button type="submit" class="btn btn-primary">确定</button>',
            onCreate: function (modal) {
                $(modal.element).on("click", "button[type='submit']", function (event) {
                    event.preventDefault()
                    var $form = $(modal.element).find("form");    
                    modal.hide()
                })
            }
        })
        }
    })
   	}	

    function  gogo(arr)
    {
		$.ajax({  
		      url: "/admin/up",  
		      type:"post",
		      data:arr,
		      dataType:'json',
		      async: true,  
		      success: function(data){  




		          if(data==0){
		          	swal("修改失败", "数据未修改!!!",
					"error"); 
		          }else{
		          	var arr=['<span class="badge badge-warning">未发货</span>','<span class="badge badge-info">已发货</span>','<span class="badge badge-info">已收货</span>','<span class="badge badge-info">未付款</span>','<span class="badge badge-error">无效订单</span>'];
		          	$('.'+data.id).children("td").eq(1).text(data.dhao);
		          	$('.'+data.id).children("td").eq(3).text(data.onum);
		          	$('.'+data.id).children("td").eq(4).text(data.ototal+'.00¥');
		          	$('.'+data.id).children("td").eq(5).text(data.oaddress);
		          	$('.'+data.id).children("td").eq(6).html(arr[data.ostatus]);
		          	swal("修改成功", "你的订单已经修改成功",
					"success"); 
		          }
		      }  
		});  
  //   	swal("修改", "修改订单成功!",
		// "success"); 
    }
</script>

@stop