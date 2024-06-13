<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\PermohonanSlik;
use App\Models\Slik;
use App\Services\SlikService;
use Illuminate\Http\Request;

class SlikController extends Controller
{
    private SlikService $slikService;

    public function __construct(SlikService $slikService) {
        $this->slikService = $slikService;
    }

    public function index() {
        $sliks = Slik::orderBy('created_at', 'DESC')->get();
        return view('admin.slik.index', compact('sliks'));
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
            if($request->input('nama')[0] == null || $request->input('nik')[0] == null){
                return redirect()->back()->with('error', 'Wajib Megisikan Minimal Identitas Debitur / Calon Debitur')->withInput($request->all());
            }
            $this->slikService->create($request);
            return redirect()->route('admin.permohonan-slik.create')->with('success', 'Berhasil melakukan permohonan, untuk melihat hasil pengajuan terdapat di menu history permohonan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan permohonan , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function done($id) {
        try {
            $this->slikService->done($id);
            return redirect()->back()->with('success', 'SLIK telah selesai');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan permohonan , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function startSlik($id) {
        try {
            $this->slikService->startSlik($id);
            return redirect()->back()->with('success', 'Memulai Proses SLIK');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan permohonan , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }
}
