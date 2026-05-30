@extends('admin.templates.app')

@section('title', 'Edit Jenis Jaminan')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Jenis Jaminan</h5>
                {!! Form::open(['route' => ['admin.jenis-jaminan.update', ['id' => $jenisjaminan->id]], 'method' => 'PUT', 'class' => ['row']]) !!}
                    <div class="col-12">
                        {!! Form::label('nama', 'Jenis Jaminan') !!}
                        {!! Form::text('nama', $jenisjaminan->nama, ['class' => 'form-control']) !!}
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