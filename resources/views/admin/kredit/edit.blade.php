@extends('admin.templates.app')

@section('title', 'Edit Categori')
@section('content')
<div class="col-lg-12">
    <a href="{{ route('admin.kredit.index') }}" class="btn btn-primary shadow-sm mb-1">Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Kredit</h6>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => ['admin.kredit.update', 'id' => $kredit->id], 'method' => 'PUT', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('no_kredit', 'Nomer Kredit') !!}
                {!! Form::text('no_kredit', $kredit->no_kredit ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nama_peminjam', 'Nama Peminjam') !!}
                {!! Form::text('nama_peminjam', $kredit->nama_peminjam ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tanggal_akad', 'Tanggal Akad') !!}
                {!! Form::date('tanggal_akad',  $kredit->tanggal_akad  ,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('kategori_id', 'Kategori Kredit') !!}
                {!! Form::select('kategori_id', $kategori, $kredit->kategori_id, ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File Kredit') !!}
                <br>
                <a href="{{ route('admin.kredit.file', ['id' => $kredit->id]) }}" target="_blank">lihat file<i class="fas fa-external-link-alt"></i></a>
                {!! Form::file('file' ,['class' => 'form-control']) !!}

                <span class="text-danger text-small">* format pdf</span>
            </div>
                {!! Form::submit('Simpan', ['class' => ['btn', 'btn-primary', 'btn-sm']]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
