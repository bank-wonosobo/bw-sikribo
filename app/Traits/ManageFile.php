<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManageFile {
    public function delete($path) {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function deleteFileExist($obj, $nama_column = 'file'){
        if ($obj->$nama_column != null) {
            $this->delete($obj->$nama_column);
        }
    }
}
