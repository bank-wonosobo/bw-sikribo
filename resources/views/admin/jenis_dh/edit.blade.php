@extends('admin.templates.app')

@section('title', 'Jenis Dokumen Hukum')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Jenis Dokumen Hukum</h5>
                {!! Form::open(['route' => ['admin.jenis-dh.update', ['id' => $jenisdh->id]], 'method' => 'PUT', 'class' => ['row']]) !!}
                    <div class="col-12">
                        {!! Form::label('nama', 'Jenis Dokumen') !!}
                        {!! Form::text('nama', $jenisdh->nama, ['class' => 'form-control']) !!}
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
