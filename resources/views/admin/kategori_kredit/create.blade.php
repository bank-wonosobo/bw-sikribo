<div class="col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Kredit</h6>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.kategori-kredit.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('nama', 'Nama Kategori') !!}
                    {!! Form::text('nama', old('nama') ,['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Simpan', ['class' => ['btn', 'btn-primary', 'btn-sm']]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
