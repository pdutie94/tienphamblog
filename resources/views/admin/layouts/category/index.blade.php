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
        </div>
        <div class="widget-content">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
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
                            <a href="javascript:;" class="btn btn-danger btn-small" data-toggle="tooltip" title="Xóa"><i class="btn-icon-only icon-trash"></i></a>
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