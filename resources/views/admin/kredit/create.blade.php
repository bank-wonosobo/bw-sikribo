<div class="modal fade" id="basicModal"  tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Basic Modal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['route' => 'admin.kredit.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="modal-body row g-3">
            <div class="col-12">
                {!! Form::label('no_kredit', 'Nomer Kredit', ['class' => 'form-label']) !!}
                {!! Form::text('no_kredit', old('no_kredit') ,['class' => 'form-control']) !!}
            </div>
            <div class="col-12">
                {!! Form::label('nama_peminjam', 'Nama Peminjam', ['class' => 'form-label']) !!}
                {!! Form::text('nama_peminjam', old('nama_peminjam') ,['class' => 'form-control']) !!}
            </div>
            <div class="col-12">
                {!! Form::label('tanggal_akad', 'Tanggal Akad', ['class' => 'form-label']) !!}
                {!! Form::date('tanggal_akad', old('tanggal_akad') ,['class' => 'form-control']) !!}
            </div>
            <div class="col-12">
                {!! Form::label('kategori_id', 'Kategori Kredit', ['class' => 'form-label']) !!}
                {!! Form::select('kategori_id', $kategori, null, ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
            </div>
            <div class="col-12">
                {!! Form::label('file', 'File Kredit', ['class' => 'form-label']) !!}
                {!! Form::file('file' ,['class' => 'form-control']) !!}

                <span class="text-danger text-small">* format pdf</span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div><!-- End Basic Modal-->
