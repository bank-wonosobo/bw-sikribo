<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Arsip</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['route' => 'admin.kredit.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('no_kredit', 'Nomer Kredit') !!}
                {!! Form::text('no_kredit', old('no_kredit') ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nama_peminjam', 'Nama Peminjam') !!}
                {!! Form::text('nama_peminjam', old('nama_peminjam') ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tanggal_akad', 'Tanggal Akad') !!}
                {!! Form::date('tanggal_akad', old('tanggal_akad') ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('kategori_id', 'Kategori Kredit') !!}
                {!! Form::select('kategori_id', $kategori, null, ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File Kredit') !!}
                {!! Form::file('file' ,['class' => 'form-control']) !!}

                <span class="text-danger text-small">* format pdf</span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
