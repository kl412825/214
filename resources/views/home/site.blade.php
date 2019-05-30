@extends('home/self')
@section('name', '收货地址')
@section('gai')
	<!-- <link rel="stylesheet" type="text/css" href="/site/css/htmleaf-demo.css"> -->
	<!-- <link href="/site/css/main.css" rel="stylesheet"> -->
<script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="/site/js/distpicker.data.js"></script>
	  <script src="/site/js/distpicker.js"></script>
	  <script src="/site/js/main.js"></script>
	  <meta name="csrf-token" content="{{ csrf_token() }}"> 
	<div class="span16">
    <div class="xm-line-box uc-box uc-order-detail-box">
        <div class="box-hd">
            <h3 class="title">
                收货地址
            </h3>
            <div class="more">
                <a  onclick="ajax_add_address()" class="btn btn-primary btn-small">
                    添加收货地址
                </a>
            </div>
        </div>
        <div class="box-bd">
            <table class="table table-bordered table-hover" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th width="12%">
                            收货人
                        </th>
                        <th width="40%">
                            收货地址
                        </th>
                        <th width="8%">
                            邮编
                        </th>
                        <th width="14%">
                            手机
                        </th>
                        
                        <th width="12%">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id='tabl'>
                	@foreach($rs as $v)
                    <tr id='tr{{$v->id}}'>
                        <td class='name{{$v->id}}'>{{$v->name}}</td>
                        <td>
                            <font class='cont{{$v->id}}'>{{$v->cont}}</font>
                            <br>
                            <font>{{$v->province}}</font>
                        </td>
                        <td class='bian{{$v->id}}'>{{$v->bian}}</td>
                        <td class='phone{{$v->id}}'>{{$v->phone}}</td>
                        
                        <td>
                            <a  onclick="ajax_add_address({{$v->id}})">
                                修改
                            </a>
                            &nbsp;&nbsp;
                            <a  onclick="return delsite({{$v->id}})">
                                删除
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- 分割线 -->
<!-- 分割线 -->
<!-- 分割线 -->
<!-- 分割线 -->
<div id="myModal" class="modal hide fade in" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="false" style="display:none;">
    <div class="modal-header">
        <button type="button" class="close" onclick="ajax_add_address()" data-dismiss="modal" aria-hidden="true">
            ×
        </button>
        <h3 id="myModalLabel">
            地址信息添加
        </h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
            <label class="control-label">
                收货人姓名
                <span class="must_add_value">
                    *
                </span>
            </label>
            <div class="controls">
                <input type="text" id="true_name" name="true_name" class="span2" placeholder="填写收货人姓名">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                省市区
                <span class="must_add_value">
                    *
                </span>
            </label>
            <div class="controls">
      <div data-toggle="distpicker">
        <div class="form-group">
          <label class="sr-only" for="province1">省</label>
          <select class="form-control" id="province1"></select>
        </div>
        <div class="form-group">
          <label class="sr-only" for="city1">市</label>
          <select class="form-control" id="city1"></select>
        </div>
        <div class="form-group">
          <label class="sr-only" for="district1">区</label>
          <select class="form-control" id="district1"></select>
        </div>
      </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                街道地址
                <span class="must_add_value">
                    *
                </span>
            </label>
            <div class="controls">
                <input type="text" id="address" name="address" class="span3" placeholder="填写街道详细地址">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                邮政编码
                <span class="must_add_value">
                    *
                </span>
            </label>
            <div class="controls">
                <input type="text" id="zip_code" name="zip_code" class="span2" placeholder="填写邮政编码">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                手机号码
                <span class="must_add_value">
                    *
                </span>
            </label>
            <div class="controls">
                <input type="text" id="mod_phone" name="mod_phone" class="span3" placeholder="添加手机号码">
            </div>
        </div>
        <span  style="display:none;" id='id'>null</span>
        <div class="control-group">
            <label class="control-label">
                默认地址
            </label>
            <div class="controls">
                <select id='moren'>
                	<option value='1'>是</option>
                	<option value='0'>否</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="address_security" value="3ce2505a1a5aa2ad87ef9586a3b44555-377a8100315ace937e823cd90d04e3ff">
        <!-- button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button -->
        <button onclick="submit()" class="btn btn-primary">
            保存修改	
        </button>
    </div>
</div>
<script type="text/javascript">
	function ajax_add_address(ac){
		$('#id').text('null');
			$('#address').val('');
			$('#zip_code').val('');
			$('#mod_phone').val('');
			$('#true_name').val('');
		if(ac!=null){
			
			var arr={};
			arr['oname'] = $('.name'+ac).text();
			arr['cont'] = $('.cont'+ac).text();
			arr['bian'] = $('.bian'+ac).text();
			arr['phone'] = $('.phone'+ac).text();
			arr['name'] = $('#true_name').val();
			console.log(arr.cont);
			$('#address').val(arr.cont);
			$('#zip_code').val(arr.bian);
			$('#mod_phone').val(arr.phone);
			$('#true_name').val(arr.oname);
			$('#id').text(ac);
			$('#myModal').css('display','block');
			
		}else{
			
			if($('#myModal').css('display')=='block'){
				
				$('#myModal').css('display','none');
			}else{
				
				$('#myModal').css('display','block');
			}
		}
	}
	function submit(){
		var arr={};
		arr['name'] = $('#true_name').val();
		
		arr['province'] = $('#province1').val()+'-'+$('#city1').val()+'-'+$('#district1').val();
		arr['cont'] = $('#address').val();
		arr['bian'] = $('#zip_code').val();
		arr['phone'] = $('#mod_phone').val();
		arr['moren'] = $('#moren').val();
		for (var index in arr){
		   if(arr[index]==''){
		   	 return alert('请填写完整');
		   }
		}
		if($('#id').text()!='null'){
			arr['id'] = $('#id').text();
			$.get('/user/addsite',arr,function(data){
			alert('修改成功');			
			ajax_add_address();
			console.log(data);
			$('#tr'+data.id).html('<td class=name'+data.id+'>'+data.name+'</td><td><font class=cont'+data.id+'>'+data.cont+'</font><br><font>'+data.province+'</font></td><td class=bian'+data.id+'>'+data.bian+'</td><td class=phone'+data.id+'>'+data.phone+'</td><td><a onclick="ajax_add_address('+data.id+')">修改</a>&nbsp;&nbsp;<a onclick="return delsite('+data.id+')">删除</a></td>');

			})

		}else{
			$.get('/user/addsite',arr,function(data){
			alert('添加成功');
			ajax_add_address();
			
			$('#tabl').append('<tr id=tr'+data.id+'><td class=name'+data.id+'>'+data.name+'</td><td><font class=cont'+data.id+'>'+data.cont+'</font><br><font>'+data.province+'</font></td><td class=bian'+data.id+'>'+data.bian+'</td><td class=phone'+data.id+'>'+data.phone+'</td><td><a onclick="ajax_add_address('+data.id+')">修改</a>&nbsp;&nbsp;<a onclick="return delsite('+data.id+')">删除</a></td></tr>');
			})

		}
		
		
	}
	function delsite(id){

		if(confirm("确认要删除吗")){
			$.post('/user/delsite',{'id':id,'_token':'{{csrf_token()}}'},function(data){})
			$('#tr'+id).remove();
		}

		
	}
</script>
@stop