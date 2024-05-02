<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ManageFile {
    public function deleteFileExist($kredit){
        if ($kredit->file != null) {
            $this->delete($kredit->file);
        }
    }
}
