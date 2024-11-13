@extends('admin.templates.app')

@section('title', 'Edit Categori')

@include('admin.templates.components.loader')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.kredit.index') }}" class="btn btn-light mt-3"><i class='bx bx-chevron-left' ></i> Kembali</a>

                <h5 class="card-title">Edit Jaminan Kredit</h5>
                {!! Form::open(['route' => ['admin.kredit.update', 'id' => $kredit->id], 'method' => 'PUT', 'files' => true, 'class' => 'row g-3']) !!}

                <div class="col-12">
                    {!! Form::label('no_kredit', 'Nomer Kredit', ['class' => 'form-label']) !!}
                    {!! Form::text('no_kredit', $kredit->no_kredit ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12">
                    {!! Form::label('nama_peminjam', 'Nama Peminjam', ['class' => 'form-label']) !!}
                    {!! Form::text('nama_peminjam', $kredit->nama_peminjam ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12">
                    {!! Form::label('tanggal_akad', 'Tanggal Akad', ['class' => 'form-label']) !!}
                    {!! Form::date('tanggal_akad',  $kredit->tanggal_akad  ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12">
                    {!! Form::label('kategori_id', 'Kategori Kredit', ['class' => 'form-label']) !!}
                    {!! Form::select('kategori_id', $kategori, $kredit->kategori_id, ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('status_pengikatan', 'Status Pengikatan', ['class' => 'form-label']) !!}
                    {!! Form::select('status_pengikatan', ["SELESAI"=> "Selesai", "BELUM SELESAI" => "Belum Selesai"], $kredit->status_pengikatan, ['class' => 'form-control', 'placeholder','placeholder' => '=== Status Pengikatan ===']) !!}
                </div>
                 <h5 class="card-title mt-3">Jaminan</h5>

                <div class="col-12">
                    {!! Form::label('no_jaminan', 'Nomer Jaminan', ['class' => 'form-label']) !!}
                    {!! Form::text('no_jaminan', $kredit->no_jaminan ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('jenis_jaminan_id', 'Jenis Jaminan', ['class' => 'form-label']) !!}
                    {!! Form::select('jenis_jaminan_id', $jenis_jaminan, $kredit->jenis_jaminan_id, ['class' => 'form-control', 'placeholder','placeholder' => '=== Pilih Jenis Jaminan ===']) !!}
                </div>

                <div class="col-12">
                    {!! Form::label('file', 'File Kredit', ['class' => 'form-label']) !!}
                    <br>
                    <a href="{{ route('admin.kredit.file', ['id' => $kredit->id]) }}" target="_blank">lihat file<i class="fas fa-external-link-alt"></i></a>
                    {!! Form::file('file' ,['class' => 'form-control']) !!}

                    <span class="text-danger text-small">* format pdf</span>
                </div>
                <div class="text-left">
                    {!! Form::submit('Simpan', ['class' => ['btn', 'btn-dark']]) !!}
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-lg-12">
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
</div> --}}
@endsection
