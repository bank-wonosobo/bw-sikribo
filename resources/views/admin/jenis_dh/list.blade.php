<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Jenis Dokumen Hukum</h5>
        <div class="table-responsive">
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Dokumen</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @foreach ($jenisdh as $jdh)
              <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $jdh->nama }}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a>
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
