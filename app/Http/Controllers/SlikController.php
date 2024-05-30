<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\PermohonanSlik;
use App\Services\SlikService;
use Illuminate\Http\Request;

class SlikController extends Controller
{
    private SlikService $slikService;

    public function __construct(SlikService $slikService) {
        $this->slikService = $slikService;
    }

    public function create(string $permohonan_slik_id) {
        $permohonan_slik = PermohonanSlik::find($permohonan_slik_id);

        if ($permohonan_slik == null) {
            abort(404, "Page Not Found");
        }

        return view('admin.slik.create', compact('permohonan_slik'));
    }

    public function store(StoreSlikReq $request) {
        try {
            $this->slikService->create($request);
            return redirect()->route('admin.permohonan-slik.create')->with('success', 'Berhasil melakukan permohonan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gagal melakukan permohonan , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }
}
