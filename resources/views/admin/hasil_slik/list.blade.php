<div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Arsip Perjanjian Kredit</h5>
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
                <th>Nama</th>
                <th data-type="date" data-format="YYYY-MM-DD hh:mm:ss">Created At</th>
                <th>File</th>
                {{-- @can('slik:manage') --}}
                <th>Aksi</th>
                {{-- @endcan --}}
            </tr>
            </thead>
            <tbody>
            @php($i = 1)
            @foreach ($sliks as $slik)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $slik->nama }}</td>
                <td>{{ $slik->created_at }}</td>
                <td><a href="{{ asset('storage' . $slik->file) }}" class="btn btn-light" target="_blank"><i class='bx bxs-file-pdf'></i></a></td>
                <td>
                @can('slik:manage')
                {{-- <a href="{{ route('admin.slik.edit', ['id' => $slik->id]) }}" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a> --}}
                <a href="{{ route('admin.slik.delete', ['id' => $slik->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
                @endcan
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
