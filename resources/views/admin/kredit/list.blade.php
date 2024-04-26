<div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Arsip Perjanjian Kredit</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3 ">
                <div class="col-md">
                    <!-- Button trigger modal -->
                    @can('kredit:manage')
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Tambah Data
                    </button>
                    @endcan
                </div>
                <div class="col-md-3">
                    <form class="navbar-search" method="get">
                        <div class="input-group">
                            <input type="text" name="key" value="{{ $_GET['key'] ?? '' }}" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomer Kredit</th>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">File Kredit</th>
                        <th scope="col">Kategori</th>
                        @can('kredit:manage')
                        <th scope="col">Action</th>
                        @endcan
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($kredits as $kredit)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $kredit->no_kredit }}</td>
                            <td>{{ $kredit->nama_peminjam }}</td>
                            <td><a href="{{ route('admin.kredit.file', ['id' => $kredit->id]) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                            <td>{{ $kredit->kategorikredit->nama }}</td>
                            @can('kredit:manage')
                            <td>
                                <a href="#" class="btn btn-sm bg-white text-success"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-sm bg-white text-danger"><i class="fas fa-trash"></i></a></a>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
