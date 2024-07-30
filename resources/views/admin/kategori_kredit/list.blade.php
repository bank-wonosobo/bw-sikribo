<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Jenis Kredit</h5>
        <div class="table-responsive">
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @foreach ($kategori as $kt)
              <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $kt->kode }}</td>
                  <td>{{ $kt->nama }}</td>
                  <td>
                    <a href="{{ route('admin.kategori-kredit.edit', ['id' => $kt->id]) }}" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                    <a href="" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
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
