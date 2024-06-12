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
}
