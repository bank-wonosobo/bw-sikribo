<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokumenHukumReq;
use App\Http\Requests\UpdateDokumenHukumReq;
use App\Models\DokumenHukum;
use App\Models\JenisDokumenHukum;
use App\Services\DokumenHukumService;
use Illuminate\Http\Request;

class DokumenHukumController extends Controller
{
    private DokumenHukumService $dokumenService;

    public function __construct(DokumenHukumService $dokumenService) {
        $this->dokumenService = $dokumenService;
    }

    public function index($jdh_id) {
        $jdh = JenisDokumenHukum::find($jdh_id);
        $dokumen_hukum = DokumenHukum::where('jenis_dokumen_hukum_id', $jdh_id)->get();
        return view('admin.dokumen_hukum.index', compact('dokumen_hukum', 'jdh'));
    }

    public function create() {
        $jenis_dh = JenisDokumenHukum::pluck('nama', 'id')->all();
        return view('admin.dokumen_hukum.create', compact('jenis_dh'));
    }

    public function store(StoreDokumenHukumReq $request) {
        try {
            $result = $this->dokumenService->create($request);
            $this->dokumenService->addFile($result->id, $request->file('file'));
            return redirect()->back()->with('success', 'Berhasil Menambah Dokumen Hukum');
        } catch (\Exception $e) {
            dd($e);
            abort(500);
        }
    }

    public function edit($id) {
        $jenis_dh = JenisDokumenHukum::pluck('nama', 'id')->all();
        $dokumen_hukum = DokumenHukum::find($id);
        return view('admin.dokumen_hukum.edit', compact('dokumen_hukum', 'jenis_dh'));
    }

    public function update(UpdateDokumenHukumReq $request, $id) {
        try {
            $result = $this->dokumenService->update($request, $id);
            $this->dokumenService->addFile($result->id, $request->file('file'));
            return redirect()->route('admin.dokumen-hukum.index', ['jdh_id' => $result->jenis_dokumen_hukum_id])->with('success', 'Berhasil Mengubah Dokumen Hukum');
        } catch (\Exception $e) {
            abort(500);
        }
    }
 }
