<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemberkasanKredit\StorePemberkasanKreditReq;
use App\Http\Requests\PemberkasanKredit\UpdatePemberkasanKreditReq;
use App\Models\KategoriKredit;
use App\Models\PemberkasanKredit;
use App\Services\PemberkasanKreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemberkasanKreditController extends Controller
{
    protected PemberkasanKreditService $service;

    public function __construct(PemberkasanKreditService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit  = (int) $request->input('limit', 10);
        $search = $request->input('search');

        $query = PemberkasanKredit::with('kategorikredit')
            ->when($search, fn($q) => $q
                ->where('nomor_register', 'like', "%{$search}%")
                ->orWhereHas('kategorikredit', fn($q2) => $q2->where('nama', 'like', "%{$search}%"))
            )
            ->latest();

        $data = $query->paginate($limit);

        return view('admin.pemberkasan_kredit.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.pemberkasan_kredit.create', compact('kategori'));
    }

    public function store(StorePemberkasanKreditReq $request)
    {
        $record = $this->service->create($request);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.pemberkasan-kredit.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(string $id)
    {
        $record   = PemberkasanKredit::findOrFail($id);
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.pemberkasan_kredit.edit', compact('record', 'kategori'));
    }

    public function update(UpdatePemberkasanKreditReq $request, string $id)
    {
        $record = $this->service->update($request, $id);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.pemberkasan-kredit.index')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(string $id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.pemberkasan-kredit.index')->with('success', 'Data berhasil dihapus');
    }

    public function file(string $id)
    {
        $record = PemberkasanKredit::findOrFail($id);
        return Storage::response($record->file);
    }
}
