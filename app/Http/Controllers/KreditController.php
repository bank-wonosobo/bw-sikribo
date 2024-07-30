<?php

namespace App\Http\Controllers;

use App\Exceptions\KategoriKreditNotFoundException;
use App\Http\Requests\Kredit\ImportKreditReq;
use App\Http\Requests\Kredit\StoreKreditReq;
use App\Http\Requests\Kredit\UpdateKreditReq;
use App\Imports\KreditImport;
use App\Models\JenisJaminan;
use App\Models\KategoriKredit;
use App\Models\Kredit;
use App\Services\KreditService;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KreditController extends Controller
{
    use UploadTrait;

    private KreditService $kredit_service;

    public function __construct(KreditService $kredit_service) {
        $this->kredit_service = $kredit_service;
    }

    public function index(Request $request) {

        $kategori = KategoriKredit::pluck('nama', 'id')->all();

        $kredits = [];
        Kredit::chunk(200, function ($chunkedKredits) use (&$kredits) {
            foreach ($chunkedKredits as $kredit) {
                $kredits[] = $kredit;
            }
        });

        return view('admin.kredit.index', compact('kredits', 'kategori'));
    }

    public function create() {
        $kategori = KategoriKredit::pluck('nama', 'id')->all();
        $jenis_jaminan = JenisJaminan::pluck('nama', 'id')->all();

        return view('admin.kredit.create', compact('kategori', 'jenis_jaminan'));
    }

    public function store(StoreKreditReq $request) {
        try {
            $kredit = $this->kredit_service->create($request);
            $this->kredit_service->addFileKredit($kredit->id, $request->file('file'));
            return redirect()->back()->with('success', 'Berhasil menambah arsip perjanjian kredit');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambah data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function file($id) {
        $kredit = Kredit::find($id);
        return view('admin.kredit.file', compact('kredit'));
    }

    public function edit($id) {
        $kredit = Kredit::find($id);
        $kategori = KategoriKredit::pluck('nama', 'id')->all();
        $jenis_jaminan = JenisJaminan::pluck('nama', 'id')->all();


        return view('admin.kredit.edit', compact('kredit', 'kategori', 'jenis_jaminan'));
    }

    public function update(UpdateKreditReq $request, int $id) {
        try {
            $kredit = $this->kredit_service->update($request, $id);
            if ($request->file('file') != null) $this->kredit_service->addFileKredit($kredit->id, $request->file('file'));
            return redirect()->back()->with('success', 'Berhasil update arsip perjanjian kredit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function delete($id)
    {
        try {
            $this->kredit_service->destroy($id);
            return redirect()->back()->with('success', 'Berhasil hapus arsip perjanjian kredit');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal hapus data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }

    public function import(ImportKreditReq $req) {
        try {
            Excel::import(new KreditImport, $req->file('file'));
            return redirect()->back()->with('success', 'Berhasil import semua data');
        } catch (KategoriKreditNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
