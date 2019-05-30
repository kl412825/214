@extends('common/admins')

@section('title','首页推荐管理修改')


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            首页推荐管理修改
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/home/management/{{$rs->id}}" method='post' enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        楼层标题
                    </label>
                    <div class="mws-form-item">
                        <input type="text" name='name' value='{{$rs->name}}' class="small">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        显示图片
                    </label>
                    <div class="mws-form-item" style="width:10%;">
                        <input type="file" name='img' class="medium"><br><br>
                        原图片:<img src="/uploads/{{$rs
                        ->img}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        权重
                    </label>
                    <div class="mws-form-item">
                        <input type="text" class="large" name='pow' value='{{$rs->pow}}' style="widows: 20%;">
                    </div>
                </div>
                
                
               <input type="hidden" name="ac" value ="create">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                       状态
                    </label>
                    <div class="mws-form-item clearfix">
                        <input type="radio"@if($rs->status==0)
                        checked
                        @endif  name="status" value='0' >

                        开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" @if($rs->status==1)
                        checked
                        @endif name="status" value='1'>关闭
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" value="提交" class="btn btn-danger">
                <input type="reset" value="重置" class="btn">
            </div>
        </form>
    </div>
</div>
@stop