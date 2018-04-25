<?php
//use App\Helpers\Helper;

?>
@extends('admin.layouts.index')

@section('stylesheet')
<link href="css/parsley.css" rel="stylesheet">
<link href="css/chosen.min.css" rel="stylesheet">
@endsection

@section('page-title')
<div class="row margin-top-30 margin-bottom-30">
	<div class="col">
		<a href="{{ route('categories') }}" class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Trở về</a>
	</div>
</div>
<div class="row margin-top-30 margin-bottom-30">
	<div class="col">
		<h3>{{ $isNew ? 'Thêm danh mục' : 'Chỉnh sửa danh mục' }}</h3>
	</div>
</div>
@endsection
@section('toolbar')
<div class="subhead margin-top-30 margin-bottom-30" id="subhead">
                <div class="btn-toolbar" id="toolbar">
                    <div class="btn-wrapper" id="toolbar-save">
                        <button onclick="$('#edit-category').submit()" class="btn button-new btn-success">Lưu</button>
                    </div>
                    <div class="btn-wrapper" id="toolbar-edit">
                        <button onclick="javascript:void(0)" class="btn btn-success button-save2new">Lưu & Thêm mới</button>
                    </div>
                    <div class="btn-wrapper" id="toolbar-publish">
                        <button onclick="javascript:void(0)" class="btn btn-success button-save2copy">Lưu & Sao chép</button>
                    </div>
                </div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="form-edit-wrap">
			<form id="edit-category" class="form-horizontal" data-parsley-validate method="post" action="{{ route('save_category') }}" enctype="multipart/form-data">

				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="title">Tiêu đề <span>*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm" id="title" name="title" value="{{ ($data != NULL && $data != '') ? $data->title : '' }}" required="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="slug">Slug</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{ ($data != NULL && $data != '') ? $data->slug : '' }}" >
						<small class="form-text text-muted">Slug sẽ tự tạo theo tiêu đề của danh mục nếu bỏ trống.</small>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="image">Ảnh</label>
					<div class="col-sm-10" id="image-box">
						@if(isset($data->image) && $data->image != NULL && $data->image != '')
						<img id="prev-image" src="{{ URL::to('/') . '/' . $data->image }}" alt="" class="prev-image" width="100"/>
						<button type="button" name="select_image" class="btn btn-primary btn-sm" id="select-image">Thay đổi</button>
						<button type="button" class="btn btn-danger btn-sm" id="del-image" onclick="deleteImage()">Xóa</button>
						@else
						<img id="prev-image" src="#" alt="" class="prev-image d-none"/>
						<button type="button" name="select_image" class="btn btn-primary btn-sm" id="select-image">Chọn ảnh</button>
						<button type="button" class="btn-sm btn btn-danger d-none" id="del-image" onclick="deleteImage()">Xóa</button>
						@endif
						<input type="file" class="d-none" id="image" name="image" value="" onchange="readURL(this)">
					</div> 		
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="parent_cat">Danh mục cha
					</label>
					<div class="col-sm-10">
						<select class="form-control form-control-sm" id="parent_cat" name="parent_cat">
						<option value="0">Chọn danh mục</option>
						@foreach($listCategory as $cat)
						<option value="{{$cat->id}}" {{ ($data != NULL && $data != '' && $data->parent_id == $cat->id) ? 'selected' : '' }}>{{$cat->title}}</option>
						@endforeach
						</select>
					</div> <!-- /controls -->		
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="description">Mô tả</label>
					<div class="col-sm-10">
					<textarea name="description" id="description" class="form-control" rows="5">{{ ($data != NULL && $data != '') ? $data->description : '' }}</textarea>	
					</div> <!-- /controls -->		
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label col-form-label-sm" for="state">Xuất bản</label>
					<div class="col-sm-10">
						<label id="state">
							<input type="checkbox" name="state" value="1" {{ ($data != NULL && $data != '' && $data->state == 1) ? 'checked=""' : '' }}>
							<span class="checkmark"></span>
						</label>
					</div> <!-- /controls -->		
				</div>
				<input type="hidden" name="id" id="cat_id" value="{{ $isNew ? '0' : $data->id }}">
				<input type="hidden" name="remove_img" id="remove_img" value="0">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>

@endsection

@section('bottom-scripts')
<script src="js/parsley.min.js"></script>
<script src="js/vi.js"></script>
<script src="js/tinymce.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script>
	/*$(".chosen-select").chosen();*/
	$(document).ready(function() {
		$('#select-image').click(function() {
			$('#image').click();
		});
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#prev-image, #del-image').removeClass('d-none');
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
		$('#prev-image, #del-image').addClass('d-none');
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