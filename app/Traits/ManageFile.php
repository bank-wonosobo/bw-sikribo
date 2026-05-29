<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManageFile {
    public function delete($path) {
        // $disk = Storage::disk(config('filesystems.default'));
        if (Storage::disk(config('filesystems.default'))->exists($path)) {
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }

    public function deleteFileExist($obj, $nama_column = 'file'){
        if ($obj->$nama_column != null) {
            $this->delete($obj->$nama_column);
        }
    }
}
