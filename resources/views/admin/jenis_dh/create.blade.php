<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tambah Jenis Dokumen Hukum</h5>
            {!! Form::open(['route' => 'admin.jenis-dh.store', 'method' => 'POST', 'class' => ['row']]) !!}
                <div class="col-12">
                    {!! Form::label('nama', 'Jenis Dokumen') !!}
                    {!! Form::text('nama', old('nama') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-2">
                    {!! Form::submit('Simpan', ['class' => ['btn', 'btn-dark']]) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
