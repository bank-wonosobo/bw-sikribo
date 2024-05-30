<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploads($file, $path, $rename=true, $name=null)
    {
        if ($file) {
            $filePath =  '/' . $path . '/' . $file->getClientOriginalName();
            if($rename) {
                $fileName = $name ?? time();
                $fileType  = $file->getClientOriginalExtension();
                $filePath  = '/' . $path . '/'. $fileName . '.' . $fileType;
            }
            Storage::disk('public')->put($filePath, File::get($file));
            return $filePath;
        }
    }
}
