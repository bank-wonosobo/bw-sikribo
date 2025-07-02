<?php

namespace App\Http\Controllers;

use App\Exceptions\KodeSLIKNotSetException;
use App\Exceptions\NomorSLIKCanotSameException;
use App\Http\Requests\PermohonanSlik\EditBerkasPermohonanSlikReq;
use App\Http\Requests\PermohonanSlik\StorePermohohonanSlikReq;
use App\Models\AntrianPermohonanSlik;
use App\Models\HasilSlik;
use App\Models\KodeSlik;
use App\Models\PermohonanSlik;
use App\Models\Slik;
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
        $permohonan_slik = PermohonanSlik::where('status', 'PROSES PENGAJUAN')->orWhere('status', 'PROSES SLIK')->orderBy('status', 'ASC')->orderBy('created_at', 'ASC')->get();
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


    public function edit($id) {
        $permohonan_slik = PermohonanSlik::find($id);

        $sliks = Slik::where('permohonan_slik_id', $permohonan_slik->id)->get();

        return view('admin.permohonan_slik.edit', compact('permohonan_slik', 'sliks'));
    }

    public function updateBerkas(EditBerkasPermohonanSlikReq $request, $id) {
        try {
            $result = $this->permohonanSlikService->addBerkas($id, $request->file('berkas'));
            return redirect()->back()->with('success', 'Berhasil update berkas');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal update berkas, sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function proccess($id) {
        $permohonan_slik = PermohonanSlik::find($id);
        $antrian_permohonan = AntrianPermohonanSlik::where('permohonan_slik_id', $id)->first();
        return view('admin.permohonan_slik.proccess', compact('antrian_permohonan', 'permohonan_slik'));
    }

    public function reject($id) {
        try {
            $this->permohonanSlikService->reject($id);
            return redirect()->back()->with('success', 'Berhasil Tolak Permohonan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Gagal tolak permohonan');
        }
    }

    public function procesSlik($id) {
        try {
            $this->permohonanSlikService->processSlik($id);
            return redirect()->back()->with('success', 'Berhasil Memproses Permohonan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Gagal Memproses permohonan');
        }
    }

    public function done($id) {
        try {
            $this->permohonanSlikService->done($id);
            return redirect()->back()->with('success', 'Berhasil Menyelasaikan Permohonan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Gagal Menyelasaikan permohonan');
        }
    }
}
