
<div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Arsip Perjanjian Kredit</h5>
        @can('arsip_kredit.create')
            <a href="{{ route('admin.kredit.create') }}" class="btn btn-sm btn-dark rounded-0 mb-4">
            Tambah Data
            </a>
        @endcan

        @can('arsip_kredit.import')
            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#importkredit">
                Import Data
            </button>
        @endcan

        <form method="GET" action="{{ route('admin.kredit.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari nama peminjam, no kredit, jenis kredit, no jaminan, status"
                >
            </div>
            <div class="col-md-2">
                <select name="limit" class="form-select">
                    @foreach ([10, 25, 50, 100] as $option)
                        <option value="{{ $option }}" {{ (int) request('limit', 10) === $option ? 'selected' : '' }}>
                            {{ $option }} / halaman
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.kredit.index') }}" class="btn btn-light">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
        <!-- Table with stripped rows -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nomer Kredit</th>
                <th>Jenis Kredit</th>
                <th>No Penyimpanan / Jaminan</th>
                <th>Tanggal Akad</th>
                <th>Status Pengikatan</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($kredits as $kredit)
            <tr>
                <td>{{ $kredits->firstItem() + $loop->index }}</td>
                <td>{{ $kredit->nama_peminjam }}</td>
                <td>{{ $kredit->no_kredit }}</td>
                <td>{{ $kredit->kategorikredit->nama }}</td>
                <td>{{ $kredit->no_jaminan }}</td>
                <td>{{ Carbon\Carbon::parse($kredit->tanggal_akad)->format('d M Y') }}

                </td>
                <td>
                    @if ($kredit->status_pengikatan == "SELESAI")
                        <span class="badge bg-primary">{{ $kredit->status_pengikatan }}</span>
                    @else
                        <span class="badge bg-warning">{{ $kredit->status_pengikatan }}</span>
                    @endif
                </td>
                <td>
                    @if ($kredit->file == null)
                        <badge class="text-sm">Dokumen Belum Tersedia</badge>
                    @else
                        <a href="{{ route('admin.kredit.file', ['id' => $kredit->id]) }}" class="btn btn-light" target="_blank"><i class='bx bxs-file-pdf'></i></a>
                    @endif
                </td>
                <td class="d-flex">
                @can('arsip_kredit.edit')
                    <a href="{{ route('admin.kredit.edit', ['id' => $kredit->id]) }}" class="btn btn-sm btn-success rounded-0"><i class="bx bx-edit-alt me-1"></i></a>
                @endcan
                @can('arsip_kredit.delete')
                    <a href="{{ route('admin.kredit.delete', ['id' => $kredit->id]) }}" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
                @endcan
                <a href="#" class="btn btn-sm btn-info rounded-0"><i class='bx bx-info-circle'></i></a>
                {{-- <form method="POST" action="{{ route('admin.kredit.delete', ['id' => $kredit->id]) }}" onSubmit="return confirm('Do you want to delete?') ">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm bg-white text-danger"><i class="fas fa-trash"></i></button>
                </form> --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
        <!-- End Table with stripped rows -->
        </div>
        <div class="mt-3">
            {{ $kredits->withQueryString()->links() }}
        </div>
    </div>
    </div>

</div>
