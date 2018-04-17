<?php
use App\Helpers\Helper;
?>
@extends('admin.layouts.index')
@section('content')
<div class="span12">
    <div class="widget widget-table action-table">
        <div class="widget-header">
            <i class="icon-list-alt"></i>
            <h3>DANH MỤC</h3>
            <a href="#" class="add-category">Thêm mới</a>
            <div class="search-box">
                <form action="{{ route('categories') }}" method="get">
                    <label for="input-search">Tìm kiếm</label>
                    <input type="text" name="search" id="input-search">
                </form>
            </div>
        </div>
        <div class="widget-content">
            <div class="actions-box">
                <select name="actions" id="actions" class="actions">
                    <option value="1">Xuất bản</option>
                    <option value="0">Ngừng xuất bản</option>
                    <option value="2">Xóa</option>
                </select>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="1%"><input type="checkbox" id="select_all"/></th>
                        <th width="1%">ID</th>
                        <th width="7%">Trạng thái</th>
                        <th width="nowrap">Tên danh mục</th>
                        <th width="10%">Ảnh</th>
                        <th width="15%">Cập nhật lúc</th>
                        <th width="15%" class="td-actions">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($listCategory))
                    @foreach($listCategory as $category)
                    <tr>
                        <td><input type="checkbox" name="select[]" class="checkbox"/></td>
                        <td>{{$category->id}}</td>
                        <td>{!! Helper::stateHtml($category->state) !!}</td>
                        <td><span class="data-title">{{$category->title}}</span><br><span class="data-slug">Slug: {{$category->slug}}</span>
                        </td>
                        <td>
                        @if($category->image != NULL && $category->image != '')
                        <img src="{{URL::to('/') . '/' . $category->image}}" alt="" width="100" class="img-responsive"/>
                        @endif
                        </td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                            <a href="{{ url('/admin/categories/edit/'. $category->id) }}" class="btn btn-small btn-edit" data-toggle="tooltip" title="Chỉnh sửa"><i class="btn-icon-only icon-pencil"> </i></a>
                            <a href="{{ url('/admin/categories/delete/'. $category->id) }}" class="btn btn-danger btn-small" data-toggle="tooltip" title="Xóa"><i class="btn-icon-only icon-trash"></i></a>
                        </td>
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