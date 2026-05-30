<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Arsip Komite Kredit</h5>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex gap-2 mb-4">
                @can('komite_kredit.create')
                    <a href="{{ route('admin.komite-kredit.create') }}" class="btn btn-sm btn-dark rounded-0">Tambah Data</a>
                @endcan
            </div>

            <form method="GET" action="{{ route('admin.komite-kredit.index') }}" class="row g-2 mb-3">
                <div class="col-md-6">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari nomor register, jenis kredit, atau status">
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
                    <a href="{{ route('admin.komite-kredit.index') }}" class="btn btn-light">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Register</th>
                            <th>Jenis Kredit</th>
                            <th>Status</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $data->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nomor_register }}</td>
                            <td>{{ $item->kategorikredit->nama }}</td>
                            <td>
                                @if ($item->status === 'Disetujui')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                @elseif ($item->status === 'Ditolak')
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->file)
                                    <a href="{{ route('admin.komite-kredit.file', $item->id) }}" class="btn btn-sm btn-light" target="_blank">
                                        <i class='bx bxs-file-pdf'></i>
                                    </a>
                                @else
                                    <span class="text-muted small">Belum tersedia</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                @can('komite_kredit.edit')
                                    <a href="{{ route('admin.komite-kredit.edit', $item->id) }}" class="btn btn-sm btn-success rounded-0">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                @endcan
                                @can('komite_kredit.delete')
                                    <a href="{{ route('admin.komite-kredit.delete', $item->id) }}" class="btn btn-sm btn-danger rounded-0"
                                        onclick="return confirm('Konfirmasi hapus data?')">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
