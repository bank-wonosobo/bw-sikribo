<div class="col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Kredit</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $kt)
                        <tr>
                            <td>#</td>
                            <td>{{ $kt->nama }}</td>
                            <td>
                                <a href="#" class="btn btn-sm bg-white text-success"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-sm bg-white text-danger"><i class="fas fa-trash"></i></a></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
