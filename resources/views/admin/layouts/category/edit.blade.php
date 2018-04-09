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
				<h3>Danh mục</h3>
			</div>
			<div class="widget-content">
			<form id="edit-category" class="form-horizontal" data-parsley-validate method="post" action="{{ route('save_category') }}">
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
	tinymce.init({
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
	});
</script>
@endsection