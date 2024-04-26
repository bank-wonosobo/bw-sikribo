<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Models\KategoriKredit;
use App\Models\Kredit;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class KreditController extends Controller
{
    use UploadTrait;

    public function index(Request $request) {

        $kredits = Kredit::all();
        $kategori = KategoriKredit::pluck('nama', 'id')->all();

        $key = $request->get('key');
        if ($key != null) {
            $kredits = Kredit::where('nama_peminjam', 'LIKE', "%" . $key ."%")
                ->orWhere('no_kredit', 'LIKE', "%" . $key ."%")
                ->simplePaginate(20);
        }

        return view('admin.kredit.index', compact('kredits', 'kategori'));
    }

    public function store(StoreKreditReq $request) {
        try {
            $data = $request->validated();

            $data['nama_peminjam'] = strtoupper($data['nama_peminjam']);

            $filename = $data['nama_peminjam'] . '_' . $data['no_kredit'];

            $file = $this->uploads($request->file('file'), 'perjanjian_kredit/file', true, $filename);

            $kredit = new Kredit([
                'no_kredit' => $data['no_kredit'],
                'nama_peminjam' => $data['nama_peminjam'],
                'tanggal_akad' => $data['tanggal_akad'],
                'file' => $file,
                'kategori_id' => $data['kategori_id']
            ]);

            $kredit->save();

            return redirect()->back()->with('success', 'Berhasil menambah arsip perjanjian kredit');

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function file($id) {
        $kredit = Kredit::find($id);
        return view('admin.kredit.file', compact('kredit'));
    }

    public function edit($id) {
        $kredit = Kredit::find($id);
        return view('admin.kredit.edit', compact('kredit'));
    }

    public function update() {

    }
}
