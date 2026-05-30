<?php

namespace App\Http\Controllers;

use App\Http\Requests\PraKomiteKredit\StorePraKomiteKreditReq;
use App\Http\Requests\PraKomiteKredit\UpdatePraKomiteKreditReq;
use App\Models\KategoriKredit;
use App\Models\PraKomiteKredit;
use App\Services\PraKomiteKreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PraKomiteKreditController extends Controller
{
    protected PraKomiteKreditService $service;

    public function __construct(PraKomiteKreditService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit  = (int) $request->input('limit', 10);
        $search = $request->input('search');

        $data = PraKomiteKredit::with('kategorikredit')
            ->when($search, fn($q) => $q
                ->where('nomor_register', 'like', "%{$search}%")
                ->orWhereHas('kategorikredit', fn($q2) => $q2->where('nama', 'like', "%{$search}%"))
            )
            ->latest()
            ->paginate($limit);

        return view('admin.pra_komite_kredit.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.pra_komite_kredit.create', compact('kategori'));
    }

    public function store(StorePraKomiteKreditReq $request)
    {
        $record = $this->service->create($request);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.pra-komite-kredit.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(string $id)
    {
        $record   = PraKomiteKredit::findOrFail($id);
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.pra_komite_kredit.edit', compact('record', 'kategori'));
    }

    public function update(UpdatePraKomiteKreditReq $request, string $id)
    {
        $record = $this->service->update($request, $id);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.pra-komite-kredit.index')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(string $id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.pra-komite-kredit.index')->with('success', 'Data berhasil dihapus');
    }

    public function file(string $id)
    {
        $record = PraKomiteKredit::findOrFail($id);
        return Storage::response($record->file);
    }
}
