@extends('common.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>
        <div class="mws-panel-body no-padding">

        	<form id="art_form" class="mws-form" action="/admin/user" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
                    	<label class="mws-form-label">头像</label>
                    	<div class="mws-form-item" style="width:200px;">

                    		<img id='imgs' src="{{$rs->profile}}" alt="" style="width:200px">

                        	<input id='file_upload' type="file" name='file_upload' style="position: absolute; top: 0px; right: 0px;  margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                    		
                        </div>
                    </div>
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
        		</div>
        	</form>


        </div>    	
    </div>



@stop



@section('js')
<script>

	//文档加载
	$(function () {
        $("#file_upload").change(function () {
				//  判断是否有选择上传文件
		        var imgPath = $("#file_upload").val();

		        if (imgPath == "") {
		            alert("请选择上传图片！");
		            return;
		        }
		        //判断上传文件的后缀名
		        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
		        if (strExtension != 'jpg' && strExtension != 'gif'
		            && strExtension != 'png') {
		            alert("请选择图片文件");
		            return;
		        }

		        var formData = new FormData($('#art_form')[0]);
		       	$.ajax({
		            type: "POST",
		            url: "/admin/upload",
		            data: formData,
		            contentType: false,
		            processData: false,
		            success: function(data) {
		                $('#imgs').attr('src',data);

		                location.href ='/admins';
		            },

		            error: function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("上传失败，请检查网络后重试");
		            }
		        });
        })
    })

</script>


@stop