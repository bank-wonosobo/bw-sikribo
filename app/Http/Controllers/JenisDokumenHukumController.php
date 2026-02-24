<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisDokumenHukum\StoreJeninDokumenHukumReq;
use App\Http\Requests\JenisDokumenHukum\UpdateJeninDokumenHukumReq;
use App\Models\JenisDokumenHukum;
use Illuminate\Http\Request;

class JenisDokumenHukumController extends Controller
{
    public function index() {
        $jenisdh = JenisDokumenHukum::all();
        return view('admin.jenis_dh.index', compact('jenisdh'));
    }

    public function store(StoreJeninDokumenHukumReq $request) {
        try {
            $data = $request->validated();

            $kredit = new JenisDokumenHukum([
                'nama' => $data['nama'],
            ]);

            $kredit->save();

            return redirect()->back()->with('success', 'Berhasil menambah kategori kredit');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $jenisdh = JenisDokumenHukum::findOrFail($id);
            $jenisdh->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus kategori kredit');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id) {
        $jenisdh = JenisDokumenHukum::findOrFail($id);
        return view('admin.jenis_dh.edit', compact('jenisdh'));
    }

    public function update(UpdateJeninDokumenHukumReq $request, $id) {
        try {
            $data = $request->validated();

            $jenisdh = JenisDokumenHukum::findOrFail($id);
            $jenisdh->nama = $data['nama'];
            $jenisdh->save();

            return redirect()->route('admin.jenis-dh.index')->with('success', 'Berhasil mengubah jenis dokumen hukum');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
