<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    /**
     * Upload Image for Category function
     *
     * @param [file] $file
     * @return string
     */
    public function uploadFile($file, $folder_upload) {
        $folder = public_path() .'/images/' . $folder_upload;

        if(!file_exists($folder)) {
            mkdir($folder, 0755);
        } else {
            $file->move($folder,$file->getClientOriginalName());
        }
        $image_part = 'images/' . $folder_upload . '/'.$file->getClientOriginalName();
        return $image_part;
    }
}
