<?php

namespace App\Http\Controllers;

use App\Exceptions\KodeSLIKNotSetException;
use App\Exceptions\NomorSLIKCanotSameException;
use App\Http\Requests\PermohonanSlik\StorePermohohonanSlikReq;
use App\Models\AntrianPermohonanSlik;
use App\Models\HasilSlik;
use App\Models\KodeSlik;
use App\Models\PermohonanSlik;
use App\Services\PermohonanSlikService;
use App\Traits\NumberToRoman;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Exception\NoSuchElementException;

class PermohonanSlikController extends Controller
{
    use NumberToRoman;

    private PermohonanSlikService $permohonanSlikService;

    public function __construct(PermohonanSlikService $permohonanSlikService) {
        $this->permohonanSlikService = $permohonanSlikService;
    }

    public function index() {
        $permohonan_slik = PermohonanSlik::orderBy('status', 'ASC')->orderBy('created_at', 'ASC')->get();
        return view('admin.permohonan_slik.index', compact('permohonan_slik'));
    }

    public function create() {
        $month = $this->numberToRoman(Carbon::now()->month);
        $year = Carbon::now()->year;
        $kode_slik = KodeSlik::where('user_id', Auth::user()->id)->first();
        return view('admin.permohonan_slik.create', compact('year', 'month', 'kode_slik'));
    }

    public function store(StorePermohohonanSlikReq $request) {
        $user = Auth::user();

        try {
            $result = $this->permohonanSlikService->create($request, $user->id, $user->name);
            if ($request->file('berkas') != null) $this->permohonanSlikService->addBerkas($result->id, $request->file('berkas'));
            return redirect()->route('admin.slik.create', ['permohonan_slik_id' => $result->id])->with('success', 'Berhasil malakukan permohonan, silahkan input data nasabah slik')->with('loader',true);;
        } catch (KodeSLIKNotSetException $e) {
            return redirect()->back()->with('error', 'Kode SLIK belum di set');
        }catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gagal melakukan permohonan , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function detail($id) {
        $permohonan_slik = PermohonanSlik::find($id);
        $hasil_slik = HasilSlik::where('permohonan_slik_id', $id)->get();
        return view('admin.permohonan_slik.detail', compact('permohonan_slik', 'hasil_slik'));
    }

    public function history() {
        $user = Auth::user();
        $permohonan_slik = PermohonanSlik::where('pemohon', $user->name)->orderBy('created_at', 'DESC')->get();
        return view('admin.permohonan_slik.history', compact('permohonan_slik'));
    }

    public function proccess($id) {
        $permohonan_slik = PermohonanSlik::find($id);
        $antrian_permohonan = AntrianPermohonanSlik::where('permohonan_slik_id', $id)->first();
        return view('admin.permohonan_slik.proccess', compact('antrian_permohonan', 'permohonan_slik'));
    }
}
