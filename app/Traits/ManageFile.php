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

    public function deleteFileExist($obj){
        if ($obj->file != null) {
            $this->delete($obj->file);
        }
    }
}
