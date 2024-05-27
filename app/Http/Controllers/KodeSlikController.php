<?php

namespace App\Http\Controllers;

use App\Helper\AuthUser;
use App\Http\Requests\KodeSlik\StoreKodeSlikReq;
use App\Models\KodeSlik;
use App\Services\KodeSlikService;
use Illuminate\Http\Request;

class KodeSlikController extends Controller
{
    private KodeSlikService $kodeSlikService;
    public function __construct(KodeSlikService $kodeSlikService) {
        $this->kodeSlikService = $kodeSlikService;
    }

    public function index() {

        $userid = AuthUser::user()->id;

        $kode_slik = KodeSlik::where('user_id', $userid)->first();

        $kode = [
            "GRG" => "GRG - GARUNG",
            "WTM" => "WTM - WATUMALANG",
            "WSB" => "WSB - INDUK",
            "PST" => "PST - PUSAT",
            "KRT" => "KRT - KERTEK",
            "SPR" => "SPR - SAPURAN",
            "KPL" => "KPL - KEPIL",
            "SLM" => "SLM - SELOMERTO",
            "SKHJ" => "SKHJ - SUKOHARJO",
            "WDS" => "WDS - WADASLINTANG",
            "LKS" => "LKS - LEKSONO",
        ];

        return view('admin.kode_slik.index', compact('kode','kode_slik'));
    }

    public function setCode(StoreKodeSlikReq $req) {
        $userid = AuthUser::user()->id;

        $this->kodeSlikService->setCode($req, $userid);

        return redirect()->back()->with('success', 'Berhasil Set Kode Slik');
    }
}
