<div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tambah Jenis Kredit</h5>
            {!! Form::open(['route' => 'admin.kategori-kredit.store', 'method' => 'POST', 'files' => true, 'class' => ['row']]) !!}
                <div class="col-12">
                    {!! Form::label('nama', 'Nama Kategori') !!}
                    {!! Form::text('nama', old('nama') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-2">
                    {!! Form::submit('Simpan', ['class' => ['btn', 'btn-dark']]) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
