<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisDokumenHukum\StoreJeninDokumenHukumReq;
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
}
