<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
