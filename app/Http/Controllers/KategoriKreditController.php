<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriKredit\StoreKategoryKreditReq;
use App\Http\Requests\KategoriKredit\UpdateKategoriKreditReq;
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

    public function edit($id) {
        $kategoriKredit = KategoriKredit::find($id);
        return view('admin.kategori_kredit.edit', compact('kategoriKredit'));
    }

    public function update(UpdateKategoriKreditReq $request, $id) {
        try {
            $kategoriKredit = KategoriKredit::find($id);
            $kategoriKredit->kode = $request->input('kode');
            $kategoriKredit->nama = $request->input('nama');
            $kategoriKredit->save();

            return redirect()->route('admin.kategori-kredit.index')->with('success', 'Berhasil menambah kategori kredit');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
