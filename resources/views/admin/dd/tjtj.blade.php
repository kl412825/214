@extends('common/admins')

@section('title','订单统计')

@section('content')
    <!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	<script src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
	<script src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
	<script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
	<style type="text/css">
		#imput{
			background:#FFF;
			height :100px;
			display:flex;
			width:950px;
			margin: 0 auto;
			justify-content:space-between;
		}
		#hegt{
			background:#FFF;
			height :100px;
			display:flex;
			width:750px;
			margin: 0 auto;
			justify-content:space-between;
		}
		#hegt a {
			text-decoration:none;
			font-size:18px;
			color:#9900FF;
		}
		#imput div {
			font-size:18px;
		}
	</style>
	<script src="/home/tt/js/jquery-1.9.1.js"></script>
</head>
<body>
	<div id="container" style="min-width:400px;height:400px">
	
	</div>
	<div style="background: #FFF;height :500px;">
		<div id='imput'>
			<div  class="div1" style="color:#7CB5EC;">未发货:50%(555)</div>
			<div  class="div2" style="color:#434348;">已发货:50%(555)</div>
			<div  class="div3" style="color:#39E815;">已收货:50%(555)</div>
			<div  class="div4" style="color:#F7A35C;">未付款:50%(555)</div>
			<div class="div5"  style="color:#8085E9;">无效:50%(555)</div>

		</div>
		<div id='count' style="text-align:center;font-size:18px;color:#FF00CC;height:100px;"></div>
		<div id='hegt'>
			<a href="/admin/gogo">全年订单统计</a>
			<a href='/admin/gogo?ac=m'>当月订单统计</a>
			<a href='/admin/gogo?ac=t'>当天订单统计</a>
			<a href='/admin/gogo?ac=zt'>昨日订单统计</a>
		</div>
	</div>
<script>
	var titlename;
	var ac= GetQueryString('ac');
	function GetQueryString(name)
	{
	     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	     var r = window.location.search.substr(1).match(reg);//search,查询？后面的参数，并匹配正则
	     if(r!=null)return  unescape(r[2]); return null;
	}
	if(ac==null){
		titlename='2019年全年订单分析';
	}else if(ac=='m'){
		titlename='2019年当月订单分析';
	}else if(ac == 't'){
		titlename='2019年当天订单分析';
	}else{
		titlename='2019昨天订单分析';
	}
		
	//进入ajax请求
	$.post('/home/user/cdd',{'_token':'{{csrf_token()}}','ac':ac},function(date){
		console.log(date);
		$('.div1').text('未发货:'+date[0]+'%('+date[5]+')');
		$('.div2').text('已发货:'+date[1]+'%('+date[6]+')');
		$('.div3').text('已收货:'+date[2]+'%('+date[7]+')');
		$('.div4').text('未付款:'+date[3]+'%('+date[8]+')');
		$('.div5').text('无效:'+date[4]+'%('+date[9]+')');
		var count = date[5]+date[6]+date[7]+date[8]+date[8];
		$('#count').text('总订单数:('+count+')');
		Highcharts.chart('container', {
	chart: {
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false,
		type: 'pie'
	},
	title: {
		text: titlename
	},
	tooltip: {
		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	},
	plotOptions: {
		pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				format: '<b>{point.name}</b>: {point.percentage:.1f} %',
				style: {
					color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				}
			}
		}
	},
	series: [{
		name: 'Brands',
		colorByPoint: true,
		data: [{
			name:'未发货',
			y:date[0],
			sliced: true,
			selected: true
		}, {
			name: '已发货',
			y: date[1]
		}, {
			name: '已收貨',
			y:date[2]
		}, {
			name: '未付款',
			y: date[3]
		}, {
			name: '无效',
			y: date[4]
		}]
	}]
});	
    })
	</script>
</body>
</html>
@stop