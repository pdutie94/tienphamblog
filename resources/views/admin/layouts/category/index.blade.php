<?php
use App\Helpers\Helper;
?>
@extends('admin.layouts.index')

@section('page-title')
<div class="row margin-top-30 margin-bottom-30">
	<div class="col">
		<h3>Danh sách danh mục</h3>
	</div>
</div>
@endsection

@section('toolbar')
<div class="subhead margin-top-30 margin-bottom-30" id="subhead">
                <div class="btn-toolbar" id="toolbar">
                    <div class="btn-wrapper" id="toolbar-new">
                        <a href="{{ route('new_category') }}" class="btn btn-small button-new btn-success">
                        <span class="fa fa-plus-circle icon-white" aria-hidden="true"></span>
                            Thêm mới</a>
                    </div>
                    <div class="btn-wrapper" id="toolbar-edit">
                        <button onclick="doButtonAction('button-edit', 'edit')" class="btn btn-small button-edit">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                        Chỉnh sửa</button>
                    </div>
                    <div class="btn-wrapper" id="toolbar-publish">
                        <button onclick="doButtonAction('button-edit', 'publish')" class="btn btn-small button-publish">
                        <span class="fa fa-check" aria-hidden="true"></span>
                        Xuất bản</button>
                    </div>
                    <div class="btn-wrapper" id="toolbar-unpublish">
                        <button onclick="doButtonAction('button-edit', 'unpublish')" class="btn btn-small button-unpublish">
                        <span class="fa fa-remove" aria-hidden="true"></span>
                        Ngừng xuất bản</button>
                    </div>
                    <div class="btn-wrapper" id="toolbar-del">
                        <button onclick="doButtonAction('button-edit', 'trash')" class="btn btn-small button-del">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                        Thùng rác</button>
                    </div>
                </div>
                
</div>
@endsection

@section('content')
<div class="list-wrap">
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsivre">
        <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="1%"><input type="checkbox" id="select_all"/></th>
                        <th width="10%">Trạng thái</th>
                        <th width="nowrap">Tên danh mục</th>
                        <th width="12%">Ảnh</th>
                        <th width="15%">Cập nhật lúc</th>
                        <th width="1%">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($listCategory))
                    @foreach($listCategory as $category)
                    <tr>
                        <td><input type="checkbox" name="select" class="checkbox" value="{{$category->id}}"/></td>
                        
                        <td>{!! Helper::stateHtml($category->state) !!}</td>
                        <td>
                            <a href="{{ url('admin/categories/edit/' . $category->id) }}" class="data-title">{{$category->title}}</a><br><span class="data-slug">Slug: {{$category->slug}}</span>
                        </td>
                        <td>
                        @if($category->image != NULL && $category->image != '')
                        <img src="{{URL::to('/') . '/' . $category->image}}" alt="" width="100" class="img-responsive"/>
                        @endif
                        </td>
                        <td>{{$category->updated_at}}</td>
                        <td>{{$category->id}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">Chưa có danh mục nào</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <input type="hidden" name="site_url" id="site_url" value="{{ route('categories') }}">
            <input type="hidden" name="task" id="task" value="Category">
        </div>
    </div>
</div>
</div>
@endsection

@section('bottom-scripts')
<script>
    $('#select_all').change(function() {
        var checkboxes = $(this).parents('table').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });
    
    $('.checkbox').change(function() {
        $number_checkbox = $('.checkbox').length;
        $number_checked = $('.checkbox:checked').length;
        if($number_checked < $number_checkbox) {
            $('#select_all').prop('checked', false);
        } else {
            $('#select_all').prop('checked', true);
        }
    });
    
</script>
@endsection