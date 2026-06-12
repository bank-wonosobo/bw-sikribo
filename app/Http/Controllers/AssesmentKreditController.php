<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssesmentKredit\StoreAssesmentKreditReq;
use App\Http\Requests\AssesmentKredit\UpdateAssesmentKreditReq;
use App\Models\KategoriKredit;
use App\Models\AssesmentKredit;
use App\Services\AssesmentKreditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssesmentKreditController extends Controller
{
    protected AssesmentKreditService $service;

    public function __construct(AssesmentKreditService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit  = (int) $request->input('limit', 10);
        $search = $request->input('search');

        $data = AssesmentKredit::with('kategorikredit')
            ->when($search, fn($q) => $q
                ->where('nomor_register', 'like', "%{$search}%")
                ->orWhere('nomor_kredit', 'like', "%{$search}%")
                ->orWhereHas('kategorikredit', fn($q2) => $q2->where('nama', 'like', "%{$search}%"))
            )
            ->latest()
            ->paginate($limit);

        return view('admin.assesment_kredit.index', compact('data'));
    }

    public function create()
    {
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.assesment_kredit.create', compact('kategori'));
    }

    public function store(StoreAssesmentKreditReq $request)
    {
        $record = $this->service->create($request);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.assesment-kredit.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(string $id)
    {
        $record   = AssesmentKredit::findOrFail($id);
        $kategori = KategoriKredit::pluck('nama', 'id');
        return view('admin.assesment_kredit.edit', compact('record', 'kategori'));
    }

    public function update(UpdateAssesmentKreditReq $request, string $id)
    {
        $record = $this->service->update($request, $id);
        if ($request->hasFile('file')) {
            $this->service->addFile($record->id, $request->file('file'));
        }
        return redirect()->route('admin.assesment-kredit.index')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(string $id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.assesment-kredit.index')->with('success', 'Data berhasil dihapus');
    }

    public function file(string $id)
    {
        $record = AssesmentKredit::findOrFail($id);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('s3');

        abort_if(empty($record->file) || ! $disk->exists($record->file), 404, 'File tidak ditemukan');

        return $disk->response($record->file);
    }
}
