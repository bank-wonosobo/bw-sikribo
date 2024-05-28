<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokumenHukumReq;
use App\Models\JenisDokumenHukum;
use App\Services\DokumenHukumService;
use Illuminate\Http\Request;

class DokumenHukumController extends Controller
{
    private DokumenHukumService $dokumenService;

    public function __construct(DokumenHukumService $dokumenService) {
        $this->dokumenService = $dokumenService;
    }

    public function create() {
        $jenis_dh = JenisDokumenHukum::pluck('nama', 'id')->all();
        return view('admin.dokumen_hukum.create', compact('jenis_dh'));
    }

    public function store(StoreDokumenHukumReq $request) {
        try {
            $this->dokumenService->create($request);
            return redirect()->back()->with('success', 'Berhasil Menambah Dokumen Hukum');
        } catch (\Exception $e) {
            dd($e);
            abort(500);
        }
    }
}
