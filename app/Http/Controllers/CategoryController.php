<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\File;
use App\Helpers\Helper;
use App\Http\Requests\CategoryRequest;
use Session;

class CategoryController extends Controller
{
    //
    function __construct(Category $cat)
    {
        $this->category = $cat;
    }

    public function index() {
        $listCategory = $this->category->getListCategory();
        return view('admin.layouts.category.index', ['listCategory' => $listCategory]);
    }

    public function edit($category_id) {
        $isNew = true;
        if($category_id != 0) {
            $isNew = false;
        }
        $listCategory = $this->category->getListCategory($category_id);
        $data = $this->category->getDataCategory($category_id);
        return view('admin.layouts.category.edit', ['data' => $data, 'listCategory' => $listCategory, 'isNew' => $isNew]);
    }

    public function save(CategoryRequest $request) {
        $file = new File;
        
        if($request->slug == NULL || $request->slug == '') {
            $slug = $this->category->autoGenerateSlug($request->title);
        }
        if((int) $request->id == 0) {
            $this->category->title = $request->title;
            $this->category->slug = $slug;
            $this->category->parent_id = $request->parent_cat;
            $this->category->description = $request->description;
            if($request->hasFile('image')){
                $this->category->image = $file->uploadFile($request->image, 'thumbs');
            }
            if($request->state == NULL) {
                $this->category->state = 0;
            } else {
                $this->category->state = 1;
            }
            $this->category->save();
            $request->session()->flash('success', 'Danh mục đã tạo thành công');
        } else {
            $row = $this->category->find($request->id);
            $row->title = $request->title;
            $row->slug = $slug;
            if((int) $request->remove_img == 0) {
                if($request->hasFile('image')){
                    $row->image = $file->uploadFile($request->image, 'thumbs');
                }
            } else {
                $row->image = '';
            }
            $row->parent_id = $request->parent_cat;
            $row->description = $request->description;
            if($request->state == NULL) {
                $row->state = 0;
            } else {
                $row->state = 1;
            }
            $row->save();
            $request->session()->flash('success', 'Danh mục lưu thành công');
        }
        return redirect()->route('categories');
    }
    
    public function delete($cat_id) {
        $isDeleted = $this->category->deleteCategory($cat_id);
        if($isDeleted) {
            Session::flash('success', 'Đã xóa danh mục');
        } else {
            Session::flash('error', 'Không tìm thấy danh mục');
        }
        return redirect()->route('categories');
    }
}
