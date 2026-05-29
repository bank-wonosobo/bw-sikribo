<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Jenis Jaminan</h5>
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
                    <a href="{{ route('admin.jenis-jaminan.edit', ['id' =>$jdh->id]) }}" class="btn btn-sm btn-success"><i class="bx bx-edit-alt me-1"></i></a>
                    <form action="{{ route('admin.jenis-jaminan.destroy', ['id' => $jdh->id]) }}" method="POST" style="display:inline" onsubmit="return confirm('Konfirmasi hapus data')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i></button>
                    </form>

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
