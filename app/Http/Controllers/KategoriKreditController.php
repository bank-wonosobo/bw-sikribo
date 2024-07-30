<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriKredit\StoreKategoryKreditReq;
use App\Models\KategoriKredit;
use Illuminate\Http\Request;

class KategoriKreditController extends Controller
{
    public function index() {
        $kategori = KategoriKredit::all();
        return view('admin.kategori_kredit.index', compact('kategori'));
    }

    public function store(StoreKategoryKreditReq $request) {
        try {
            $data = $request->validated();

            $kredit = new KategoriKredit([
                'nama' => $data['nama'],
                'kode' => $data['kode']
            ]);

            $kredit->save();

            return redirect()->back()->with('success', 'Berhasil menambah kategori kredit');

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
