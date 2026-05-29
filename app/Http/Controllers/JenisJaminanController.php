<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisJaminan\StoreJenisJaminanReq;
use App\Models\JenisJaminan;
use Illuminate\Http\Request;

class JenisJaminanController extends Controller
{
    public function index() {
        $jenisdh = JenisJaminan::all();
        return view('admin.jenis_jaminan.index', compact('jenisdh'));
    }

    public function store(StoreJenisJaminanReq $request) {
        try {
            $data = $request->validated();

            $kredit = new JenisJaminan([
                'nama' => $data['nama'],
            ]);

            $kredit->save();

            return redirect()->back()->with('success', 'Berhasil menambah jenis jaminan');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id) {
        $jenisjaminan = JenisJaminan::findOrFail($id);
        return view('admin.jenis_jaminan.edit', compact('jenisjaminan'));
    }

    public function update(StoreJenisJaminanReq $request, $id) {
        try {
            $data = $request->validated();

            $jenisjaminan = JenisJaminan::findOrFail($id);
            $jenisjaminan->nama = $data['nama'];
            $jenisjaminan->save();

            return redirect()->route('admin.jenis-jaminan.index')->with('success', 'Berhasil mengubah jenis jaminan');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $jenisjaminan = JenisJaminan::findOrFail($id);
            $jenisjaminan->delete();

            return redirect()->route('admin.jenis-jaminan.index')->with('success', 'Berhasil menghapus jenis jaminan');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
