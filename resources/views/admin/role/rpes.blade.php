@extends('common.admins')


@section('content')
<style>


.demo .p1 {
  text-align: center;
  color: #666;
  font-family: cursive;
  font-size: 40px;
  text-shadow: 0 1px 0 #fff;
  letter-spacing: 1px;
  line-height: 2em;
  margin-top: 200px;
}
.demo .p2 {
  text-align: center;
  color: #666;
  font-family: cursive;
  font-size: 30px;
  text-shadow: 0 1px 0 #fff;
  letter-spacing: 1px;
  line-height: 2em;
  margin-top: 100px;
}
.demo a{
	text-decoration:none;
}
</style>
<div class="demo">
    <p class="p1">访问权限不足，请与管理员联系(´･ω･`)</p>
    <p class="p2"><a href="/admins">返回首页</a></p>
 </div>

@stop