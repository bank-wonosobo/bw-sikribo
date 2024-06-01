<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasilSlik\StoreHasilSlikReq;
use App\Models\HasilSlik;
use App\Models\Slik;
use App\Services\HasilSlikService;
use Exception;


class HasilSlikController extends Controller
{
    private HasilSlikService $hasilSlikService;

    public function __construct(HasilSlikService $hasilSlikService) {
        $this->hasilSlikService = $hasilSlikService;
    }

    public function index() {
        $sliks = HasilSlik::all();
        return view('admin.hasil_slik.index', compact('sliks'));
    }

    public function create() {
        return view('admin.hasil_slik.create');
    }

    public function store(StoreHasilSlikReq $req) {
        try {
            $result = $this->hasilSlikService->create($req);
            return response()->json(['success'=>true, 'slik_id' => $result->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $this->hasilSlikService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil hapus arsip perjanjian kredit');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal hapus data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function monthlydestroy() {
        try {
            $this->hasilSlikService->monthlydestroy();
            return redirect()->back()->with('success', 'Berhasil hapus arsip perjanjian kredit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }
}
