@extends('admin.templates.app')

@section('title', 'Kategori Kredit')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Jenis Kredit</h5>
                {!! Form::open(['route' => ['admin.kategori-kredit.update', ['id' => $kategoriKredit->id]], 'method' => 'PUT', 'files' => true, 'class' => ['row']]) !!}
                    <div class="col-12">
                        {!! Form::label('kode', 'Kode') !!}
                        {!! Form::text('kode', $kategoriKredit->kode ,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-12 mt-2">
                        {!! Form::label('nama', 'Nama Kategori') !!}
                        {!! Form::text('nama', $kategoriKredit->nama ,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-12 mt-2">
                        {!! Form::submit('Simpan', ['class' => ['btn', 'btn-dark']]) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
