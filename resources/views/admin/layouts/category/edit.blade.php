<?php
//use App\Helpers\Helper;
?>
@extends('admin.layouts.index')

@section('stylesheet')
<link href="css/parsley.css" rel="stylesheet">
@endsection

@section('content')
<div class="span12">
		<div class="widget">
			<div class="widget-header">
				<i class="icon-list-alt"></i>
				<h3>{{ $isNew ? 'Thêm danh mục' : 'Chỉnh sửa danh mục' }}</h3>
			</div>
			<div class="widget-content">
			<form id="edit-category" class="form-horizontal" data-parsley-validate method="post" action="{{ route('save_category') }}" enctype="multipart/form-data">
				<fieldset>
				<div class="control-group">
					<label class="control-label" for="title">Tiêu đề <span>*</span>
					</label>
					<div class="controls">
						<input type="text" class="span6" id="title" name="title" value="{{ ($data != NULL && $data != '') ? $data->title : '' }}" required="">
					</div> <!-- /controls -->		
				</div>
				<div class="control-group">
					<label class="control-label" for="slug">Slug <span>*</span></label>
					<div class="controls">
						<input type="text" class="span3" id="slug" name="slug" value="{{ ($data != NULL && $data != '') ? $data->slug : '' }}" required="">
						<p class="help-block">Slug sẽ tự tạo theo tiêu đề của danh mục nếu bỏ trống.</p>
					</div> <!-- /controls -->		
				</div>
				<div class="control-group"><label class="control-label" for="image">Ảnh</label>
					<div class="controls" id="image-box">
					@if(isset($data->image) && $data->image != NULL && $data->image != '')
					<img id="prev-image" src="{{ URL::to('/') . '/' . $data->image }}" alt="" class="prev-image" width="100"/>
					<button type="button" name="select_image" class="btn btn-primary" id="select-image">Thay đổi</button>
						<button type="button" class="btn btn-danger" id="del-image" onclick="deleteImage()">Xóa</button>
					@else
					<img id="prev-image" src="#" alt="" class="prev-image hidden"/>
					<button type="button" name="select_image" class="btn btn-primary" id="select-image">Chọn ảnh</button>
						<button type="button" class="btn btn-danger hidden" id="del-image" onclick="deleteImage()">Xóa</button>
					@endif
						<input type="file" class="span3 hidden" id="image" name="image" value="" onchange="readURL(this)">
					</div> <!-- /controls -->		
				</div>
				<div class="control-group">
					<label class="control-label" for="parent_cat">Danh mục cha
					</label>
					<div class="controls">
						<select class="form-control" id="parent_cat" name="parent_cat">
						<option value="0">Chọn danh mục</option>
						@foreach($listCategory as $cat)
						<option value="{{$cat->id}}" {{ ($data != NULL && $data != '' && $data->parent_id == $cat->id) ? 'selected' : '' }}>{{$cat->title}}</option>
						@endforeach
						</select>
					</div> <!-- /controls -->		
				</div>
				<div class="control-group">
					<label class="control-label" for="description">Mô tả</label>
					<div class="controls">
					<textarea name="description" id="description" class="span6" rows="6">{{ ($data != NULL && $data != '') ? $data->description : '' }}</textarea>	
					</div> <!-- /controls -->		
				</div>
				<div class="control-group">
					<label class="control-label" for="state">Xuất bản</label>
					<div class="controls">
						<label id="state">
							<input type="checkbox" name="state" value="1" {{ ($data != NULL && $data != '' && $data->state == 1) ? 'checked=""' : '' }}>
							<span class="checkmark"></span>
						</label>
					</div> <!-- /controls -->		
				</div>
				<input type="hidden" name="id" id="cat_id" value="{{ $isNew ? '0' : $data->id }}">
				<input type="hidden" name="remove_img" id="remove_img" value="0">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">{{ $isNew ? 'Thêm' : 'Lưu' }}</button> 
					<a href="{{ route('categories') }}" class="btn" title="Trở về">Trở về</a>
				</div>
				</fieldset>
			</form>
		</div>
		</div>
</div>
@endsection

@section('bottom-scripts')
<script src="js/parsley.min.js"></script>
<script src="js/vi.js"></script>
<script src="js/tinymce.min.js"></script>
<script>
	$(document).ready(function() {
		$('#select-image').click(function() {
			$('#image').click();
		});
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#prev-image, #del-image').removeClass('hidden');
				$('#prev-image')
				.attr('src', e.target.result)
				.width(100);
			};
			$('#select-image').text('Thay đổi');
			$('#remove_img').val(0);
			reader.readAsDataURL(input.files[0]);
		}
	}

	function deleteImage() {
		$('#prev-image, #del-image').addClass('hidden');
		$('#prev-image').attr('src', '#');
		$('#select-image').text('Chọn ảnh');
		$('#image').val("");
		$('#remove_img').val(1);
	}
	/*tinymce.init({
		selector: '#description',
		theme: 'modern',
		plugins: 'tpfilemanager print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount  imagetools contextmenu colorpicker textpattern help',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		image_advtab: true,
		branding: false,
		external_filemanager_path:"http://localhost/tienphamblog/public/admin/media",
		
		resize: 'both',
		filemanager_title:"TP Responsive Filemanager" ,
		external_plugins: { "filemanager" : "plugins/tpfilemanager/plugin.min.js"},
		templates: [
		]
	});*/
</script>
@endsection