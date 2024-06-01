@extends('admin.templates.app')

@section('title', 'Permohonan SLIK')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Permohonan SLIK</h4>

                <p>Masukan NIK dan Nama Identitas SLIK, minimal mengisi Debitur / Calon Debitur</p>

                {!! Form::open(['route' => 'admin.slik.store', 'method' => 'POST']) !!}
                <input type="hidden" name="permohonan_slik_id" value="{{ $permohonan_slik->id }}" />
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="card-title">Debitur/Calon Debitur</h6>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama[0]', 'Nama') !!}
                                {!! Form::text('nama[0]', old('nama[0]') ,['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('nik[0]', 'NIK') !!}
                                {!! Form::text('nik[0]', old('nik[0]') ,['class' => 'form-control']) !!}
                            </div>
                            <input type="hidden" name="identitas_slik[0]" value="Debitur/Calon Debitur" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-title">Pasangan Debitur/Calon Debitur</h6>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama[1]', 'Nama') !!}
                                {!! Form::text('nama[1]', old('nama[1]') ,['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('nik[1]', 'NIK') !!}
                                {!! Form::text('nik[1]', old('nik[1]') ,['class' => 'form-control']) !!}
                            </div>
                            <input type="hidden" name="identitas_slik[1]" value="Pasangan Debitur/Calon Debitur" >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="card-title">Penjamin</h6>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama[2]', 'Nama') !!}
                                {!! Form::text('nama[2]', old('nama[2]') ,['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('nik[2]', 'NIK') !!}
                                {!! Form::text('nik[2]', old('nik[2]') ,['class' => 'form-control']) !!}
                            </div>
                            <input type="hidden" name="identitas_slik[2]" value="Penjamin" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-title">Pasangan Pernjamin</h6>
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('nama[3]', 'Nama') !!}
                                {!! Form::text('nama[3]', old('nama[3]') ,['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('nik[3]', 'NIK') !!}
                                {!! Form::text('nik[3]', old('nik[3]') ,['class' => 'form-control']) !!}
                            </div>
                            <input type="hidden" name="identitas_slik[3]" value="Pasangan Penjamin" >
                        </div>
                    </div>

                </div>
                <div class="col-12 mt-4">
                    {!! Form::submit('Ajukan Permohonan', ['class' => ['btn', 'btn-dark']]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
