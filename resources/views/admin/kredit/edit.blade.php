@extends('admin.templates.app')

@section('title', 'Edit Categori')
@section('content')
<div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Kredit</h6>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'admin.kredit.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('no_kredit', 'Nomer Kredit') !!}
                {!! Form::text('no_kredit', old('no_kredit') ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nama_peminjam', 'Nama Peminjam') !!}
                {!! Form::text('nama_peminjam', old('nama_peminjam') ,['class' => 'form-control']) !!}
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
                {!! Form::submit('Simpan', ['class' => ['btn', 'btn-primary', 'btn-sm']]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
