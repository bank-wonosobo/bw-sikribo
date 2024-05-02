<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\Slik;
use App\Services\SlikService;
use Exception;
use Illuminate\Http\Request;

class SlikController extends Controller
{
    private SlikService $slikService;

    public function __construct(SlikService $slikService) {
        $this->slikService = $slikService;
    }

    public function index() {
        $sliks = Slik::all();
        return view('admin.slik.index', compact('sliks'));
    }

    public function create() {
        return view('admin.slik.create');
    }

    public function store(StoreSlikReq $req) {
        try {
            $result = $this->slikService->create($req);
            return response()->json(['success'=>true, 'slik_id' => $result->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $this->slikService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil hapus arsip perjanjian kredit');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal hapus data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function monthlydestroy() {
        try {
            $this->slikService->monthlydestroy();
            return redirect()->back()->with('success', 'Berhasil hapus arsip perjanjian kredit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }
}
