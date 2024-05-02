<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Arsip Perjanjian Kredit</h5>
          <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#basicModal">
           Tambah Data
          </button>

          <div class="table-responsive">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Peminjam</th>
                  <th>Kredit Nomer</th>
                  <th>File</th>
                  <th>Jenis Kredit</th>
                  <th data-type="date" data-format="YYYY-MM-DD">Tanggal Akad</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php($i = 1)
                @foreach ($kredits as $kredit)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $kredit->nama_peminjam }}</td>
                  <td>{{ $kredit->no_kredit }}</td>
                  <td><a href="{{ route('admin.kredit.file', ['id' => $kredit->id]) }}" class="btn btn-light" target="_blank"><i class='bx bxs-file-pdf'></i></a></td>
                  <td>{{ $kredit->kategorikredit->nama }}</td>
                  <td>{{ $kredit->tanggal_akad }}</td>
                  <td>
                    <a href="{{ route('admin.kredit.edit', ['id' => $kredit->id]) }}" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                    <a href="{{ route('admin.kredit.delete', ['id' => $kredit->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
                    {{-- <form method="POST" action="{{ route('admin.kredit.delete', ['id' => $kredit->id]) }}" onSubmit="return confirm('Do you want to delete?') ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm bg-white text-danger"><i class="fas fa-trash"></i></button>
                    </form> --}}
                  </td>
                </tr>
                @php($i++)
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>

    </div>
  </div>
