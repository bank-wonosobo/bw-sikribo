@extends('admin.templates.app')

@section('title', 'Kode SLIK')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set Kode SLIK</h5>
                <p>Kode SLIK saat ini : <strong>{{ $kode_slik->kode ?? 'Belum Terset' }}</strong></p>
                {!! Form::open(['route' => 'admin.kode-slik.set', 'method' => 'POST', 'files' => true]) !!}
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        {!! Form::select('kode', $kode, $kode_slik->kode ?? '', ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-dark">Set</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
