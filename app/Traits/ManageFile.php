<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManageFile {
    public function delete($path) {
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
    }

    public function deleteFileExist($obj, $nama_column = 'file'){
        if ($obj->$nama_column != null) {
            $this->delete($obj->$nama_column);
        }
    }
}
