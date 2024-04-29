<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Http\Requests\Kredit\UpdateKreditReq;
use App\Models\KategoriKredit;
use App\Models\Kredit;
use App\Services\KreditService;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class KreditController extends Controller
{
    use UploadTrait;

    private KreditService $kredit_service;

    public function __construct(KreditService $kredit_service) {
        $this->kredit_service = $kredit_service;
    }

    public function index(Request $request) {

        $kredits = Kredit::all();
        $kategori = KategoriKredit::pluck('nama', 'id')->all();

        $key = $request->get('key');
        if ($key != null) {
            $kredits = Kredit::where('nama_peminjam', 'LIKE', "%" . $key ."%")
                ->orWhere('no_kredit', 'LIKE', "%" . $key ."%")
                ->simplePaginate(20);
        }

        return view('admin.kredit.index', compact('kredits', 'kategori'));
    }

    public function store(StoreKreditReq $request) {
        try {
            $kredit = $this->kredit_service->create($request);
            $this->kredit_service->addFileKredit($kredit->id, $request->file('file'));
            return redirect()->back()->with('success', 'Berhasil menambah arsip perjanjian kredit');
        } catch (\Exception $e) {
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

        return view('admin.kredit.edit', compact('kredit', 'kategori'));
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
            return redirect()->back()->with('success', 'Berhasil update arsip perjanjian kredit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update data , sedang terjadi maintenance, coba beberapa saat lagi ');
        }
    }
}
