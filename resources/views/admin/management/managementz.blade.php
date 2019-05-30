@extends('common/admins')

@section('title','首页推荐管理子级管理')


@section('content')
<style type="text/css">
        .no{
            color:red;
        }
        .yes{
            color:#2bf666;
        }
</style>
<script src='/jquery.js'></script>
<!-- 弹窗js -->
<link rel="stylesheet" type="text/css" href="/ad/css/sweetalert.css">
<script type="text/javascript" src="/ad/js/sweetalert-dev.js"></script>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
           首页推荐管理子级管理 &nbsp;&nbsp;&nbsp;({{$rs->name}})
        </span>
        <span style="display:none;" id='uid'>{{$rs->id}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div class="mws-form" >
        	{{ csrf_field() }}
        	
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        商品id
                    </label>
                    <div class="mws-form-item">
                        <input type="text" id='spgo' name='name' class="small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                    </div>
                </div>
               <input type="hidden" name="ac" value ="create">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                       状态
                    </label>
                    <div class="mws-form-item clearfix">
                        <input type="radio" id="kq" value='0' >开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="gb" value='1'>关闭
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" value="提交" id='gogo'class="btn btn-danger">
                <input type="reset" value="重置" class="btn">
            </div>
        </form>

       </div> 
</div>
<br><br>
<div class="mws-panel-header">
        <span>
          推荐商品
        </span>
        <span style="display:none;" id='uid'>{{$rs->id}}</span>
    </div>
<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                <thead id='tabe'>

                    <tr role="row">
                        <th >序号</th>
                        <th  >
                            商品id
                        </th>                        
                        <th  >
                            商品名
                        </th> 
                        
                        <th >
                            状态
                        </th>
                        <th >
                            操作
                        </th>
                        @php 
                        static $a=1;
                        
                        @endphp
                    </tr>
                    @foreach($arr as $v)
                    <tr class='even tr{{$a}}'>
                        <th>
                            @php 
                        echo $a;
                        
                        @endphp
                        </th>
            
                        <th>
                            {{$v->gid}}
                        </th>                        
                        <th>
                            {{$v->name}}
                        </th> 
                        
                        <th>
                            <a onclick="zt({{$v->id}})" id="{{$v->id}}"  class="btn  {{$v->status}}">@php echo $brr[$v->status] @endphp</a>
                        </th>
                        <th>
                            
                            <a class='btn' onclick="del({{$v->id}},{{$a}})">删除</a>

                        </th>
                    </tr>
                        @php 
                        $a++;
                        
                        @endphp
                    @endforeach
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                   
                                                            
                                     
                   
                </tbody>
            </table>
    </div>
<script type="text/javascript">
    var pid = $('#uid').text();
    var status = 0;
    var na = null;
    $('#kq').prop('checked',true);
    $('#kq').click(function(){
        $('#kq').prop('checked',true);
        $('#gb').prop('checked',false);
        status = 0;
    })
    $('#gb').click(function(){
        $('#gb').prop('checked',true);
        $('#kq').prop('checked',false);
        status = 1;
    })
    var ok = null;
    $('#spgo').change(function(){
        var th=$(this);
        var te=$(this).val();
        $.post('/admin/management/select',{'_token':'{{csrf_token()}}','gid':te},function(date){
                if(date!=0){
                    th.next().text(date.gname);
                    th.next().attr('class','yes');
                    na = date.gname;
                    ok=te;
                }else{
                    th.next().text('未查到商品');
                    th.next().attr('class','no');
                    na = null;
                    ok=null;
                }
            }) 
    });
    $('#gogo').click(function(){
        var num = $('#tabe').children("tr:last-child").children("th:first-child").text();
        if(num=='序号'){
            num = '0';
        }
        num=parseInt(num)+1;
        var brr=['开启','关闭'];
        if(ok==null) return swal("请先输入商品id", "((*^▽^*))");
        $.post('/admin/management/add',{'_token':'{{csrf_token()}}','pid':pid,'gid':ok,'name':na,'status':status},function(date){
                if(date!=0){
                  $('#tabe').append("<tr role='row' class='even tr"+num+"'><th>"+num+"</th><th>"+date.gid+"</th><th>"+date.name+"</th><th><a onclick='zt("+date.id+")' id='"+date.id+"'  class='btn  "+date.status+"'>"+brr[date.status]+"</a></th><th><a class='btn' onclick='del("+date.id+","+num+")'>删除</a></th></tr>");
                  console.log(date.cococo);
                }else{
                   swal("添加失败", "推荐商品最大8个,请删除或禁用",
                    "error");
                }
                
        }) 
    })
    //删除
    function del(id,xx){
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
                $('.tr'+xx).remove();
            }) 
            swal("删除！", "你的订单文件已经被删除!",
        "success"); 
        } else { 
            swal("取消！", "你已取消此删除((*^▽^*))",
        "error"); 
        } 
    });

    }
    //修改状态
    function zt(id){
        var zt =$('#'+id).text();
        if(zt == '开启'){zt=0}else{zt=1}
        $.post('/home/management',{'_token':'{{csrf_token()}}','id':id,'status':zt},function(data){
            if(data!='0'){
                var brr=['开启','关闭']
                if(zt==0){zt=1}else{zt=0};
                $('#'+id).text(brr[zt]);
                $('#'+id).text(brr[zt]);
            }else{
                swal("添加失败", "推荐商品最大8个,请删除或禁用",
                    "error"); 
            }
        })
    }
</script>
@stop