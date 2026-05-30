<?php

namespace App\Http\Controllers;

use App\Http\Requests\KomiteKredit\StoreKomiteKreditReq;
use App\Http\Requests\KomiteKredit\UpdateKomiteKreditReq;
use App\Models\KategoriKredit;
use App\Models\KomiteKredit;
use App\Services\KomiteKreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KomiteKreditController extends Controller
{
    protected KomiteKreditService $service;

    public function __construct(KomiteKreditService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit  = (int) $request->input('limit', 10);
        $search = $request->input('search');

        $data = KomiteKredit::with('kategorikredit')
            ->when($search, fn($q) => $q
                ->where('nomor_register', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhereHas('kategorikredit', fn($q2) => $q2->where('nama', 'like', "%{$search}%"))
            )
            ->latest()
            ->paginate($limit);

        return view('admin.komite_kredit.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriKredit::pluck('nama', 'id');
        $statuses = [
            'Disetujui'                          => 'Disetujui',
            'Ditolak'                            => 'Ditolak',
            'Disetujui Tidak Sesuai Permohonan'  => 'Disetujui Tidak Sesuai Permohonan',
        ];
        return view('admin.komite_kredit.create', compact('kategori', 'statuses'));
    }

    public function store(StoreKomiteKreditReq $request)
    {
        $record = $this->service->create($request);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.komite-kredit.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(string $id)
    {
        $record   = KomiteKredit::findOrFail($id);
        $kategori = KategoriKredit::pluck('nama', 'id');
        $statuses = [
            'Disetujui'                          => 'Disetujui',
            'Ditolak'                            => 'Ditolak',
            'Disetujui Tidak Sesuai Permohonan'  => 'Disetujui Tidak Sesuai Permohonan',
        ];
        return view('admin.komite_kredit.edit', compact('record', 'kategori', 'statuses'));
    }

    public function update(UpdateKomiteKreditReq $request, string $id)
    {
        $record = $this->service->update($request, $id);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.komite-kredit.index')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(string $id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.komite-kredit.index')->with('success', 'Data berhasil dihapus');
    }

    public function file(string $id)
    {
        $record = KomiteKredit::findOrFail($id);
        return Storage::response($record->file);
    }
}
