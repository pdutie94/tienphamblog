<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = "categories";

    public function post() {
        return $this->hasMany('App\Post', 'cat_id', 'id');
    }

    /**
     * Undocumented function
     *
     * @param interger|array|null $except_id
     * @return array
     */
    public function getListCategory($except_id = null) {
        if(isset($except_id)) {
            if(!is_array($except_id)) {
                $list = self::where('id', '<>', $except_id)->get();
            } else {
                $list = self::whereNotIn('id', explode($except_id))->get();
            }
        } else {
            $list = self::get();
        }
        return $list;
    }

    public function getDataCategory($category_id) {
        return self::find($category_id);
    }

    public function getTreeCategory() {
        
    }

    public function autoGenerateSlug($title, $id) {
        $slug = $maybe_slug = Str::slug($title);
        $next = 1;
        $old_slug = self::where('slug', '=', $slug)->first();
        if($old_slug == NULL) {
            $slug = $maybe_slug;
        } else {
            if ($old_slug->id != $id) {
                while (self::where('slug', '=', $slug)->first()) {
                    $slug = "$maybe_slug-$next";
                    $next++;
                }
            } else {
                $slug = $maybe_slug;
            }
        }

        return $slug;
    }

    public function deleteCategory($cat_id) {
        $cat = self::find($cat_id);
        if($cat == NULL) {
            return false;
        }
        $cat->delete();

        return true;
    }
}
