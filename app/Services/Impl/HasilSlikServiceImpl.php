<?php

namespace App\Services\Impl;

use App\Http\Requests\HasilSlik\StoreHasilSlikReq;
use App\Models\HasilSlik;
use App\Models\Slik;
use App\Services\HasilSlikService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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

    public function destroying(string $id)
    {
        $slik = HasilSlik::find($id);

        $this->deleteFileExist($slik);

        HasilSlik::where('id', $id)->delete();
    }

    public function monthlydestroy()
    {
        Slik::truncate();
    }

    public function routinDeletion(int $date_amount = 14): Collection
    {
        $hasilSlik = HasilSlik::all();

        $datenow = Carbon::now()->subDays($date_amount);

        // dd($datenow);


        foreach($hasilSlik as $hasil) {
            $created_at = Carbon::parse($hasil->created_at);


            if ($datenow->gte($created_at)) {
                $this->destroying($hasil->id);
            }
        }

        return HasilSlik::all();
    }
}
