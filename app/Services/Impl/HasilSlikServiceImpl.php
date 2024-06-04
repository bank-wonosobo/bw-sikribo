<?php

namespace App\Services\Impl;

use App\Http\Requests\HasilSlik\StoreHasilSlikReq;
use App\Models\HasilSlik;
use App\Models\Slik;
use App\Services\HasilSlikService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HasilSlikServiceImpl implements HasilSlikService {
    use UploadTrait, ManageFile;

    const PATH = 'slik/file/';

    public function create(StoreHasilSlikReq $req): HasilSlik
    {

        $file = $req->file('file');

        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_path = $this->uploads($file, self::PATH, true, Carbon::now()->format('dmy') . '_'. $file_name);

        $slik = new HasilSlik([
            'nama' => $file_name,
            'file' => $file_path
        ]);

        $slik->save();

        return $slik;
    }

    public function destroy(string $id)
    {
        $slik = Slik::find($id);

        $this->deleteFileExist($slik);

        Slik::where('id', $id)->delete();
    }

    public function monthlydestroy()
    {
        Slik::truncate();
    }
}
