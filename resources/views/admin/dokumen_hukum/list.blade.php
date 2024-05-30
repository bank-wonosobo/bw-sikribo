<div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Dokumen Hukum {{ $jdh->nama }}</h5>
        @can('slik:manage')

        <a href="{{ route('admin.slik.create') }}" class="btn btn-dark mb-2" >
        Tambah Data
        </a>
        <a href="{{ route('admin.slik.monthlydestroy') }}" class="btn btn-danger mb-2" onclick="return confirm('Konfirmasi hapus data, semua data slik akan dihapus permanen !!')">
            Hapus Data Bulanan
        </a>
        @endcan
        <div class="table-responsive">
        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
            <tr>
                <th>No</th>
                <th>Nomor Dokumen</th>
                <th>Perihal</th>
                <th data-type="date" data-format="YYYY-MM-DD">Tanggal</th>
                <th>Tahun</th>
                <th>Jenis Dokumen</th>
                <th>File</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php($i = 1)
            @foreach ($dokumen_hukum as $dokumen)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $dokumen->nomor }}</td>
                <td>{{ $dokumen->perihal }}</td>
                <td>{{ $dokumen->tanggal }}</td>
                <td>{{ $dokumen->tahun }}</td>
                <td><span class="badge bg-dark">{{ $dokumen->jenisDokumen->nama }}</span></td>
                <td><a href="{{ asset('storage' . $dokumen->file) }}" class="btn btn-light" target="_blank"><i class='bx bxs-file-pdf'></i></a></td>
                <td>
                    @if ($dokumen->status != 0)
                        <span class="badge bg-success">Berlaku</span>
                    @else
                        <span class="badge bg-danger">Tidak Berlaku</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
                </td>
            </tr>
            @php($i++)
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
