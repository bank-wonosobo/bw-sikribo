@extends('admin.templates.app')

@section('title', 'Permohonan SLIK')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Permohonan SLIK</h5>
                @if ($kode_slik == null)
                    <div class="alert alert-warning" role="alert">
                        User belum <a href="{{ route('admin.kode-slik.index') }}" class="alert-link">Atur Kode SLIK</a>. atur kode SLIK untuk dapat melakukan permohonan SLIK
                    </div>
                @endif
                <p>Masukan Nomor SLIK dan Peruntukan Ideb untuk permohonan SLIK</p>
                {!! Form::open(['route' => 'admin.permohonan-slik.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="col-6 mt-3">
                    {!! Form::label('nomor', 'Nomor SLIK') !!}
                    <div class="input-group">
                      <input type="number" name="nomor" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <span class="input-group-text" id="basic-addon2">600557<b>/</b>{{ $kode_slik->kode ?? '_' }}<b>/</b>{{ $month }}<b>/</b> {{ $year }}</span>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('peruntukan_ideb', 'Peruntukan Ideb') !!}
                    {!! Form::text('peruntukan_ideb', old('peruntukan_ideb') ,['class' => 'form-control', 'placeholder' => 'ex: Permohonan SLIK']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('berkas', 'Berkas SLIK', ['class' => 'font-weight-bold']) !!}
                    {!! Form::file('berkas' ,['class' => 'form-control']) !!}
                    <span class="text-danger text-small">* berkas berisi KTP dan KK dengan format pdf, dijadikan 1 file</span>
                </div>
                <div class="col-12 mt-4">
                    {!! Form::submit('Buat Permohonan', ['class' => ['btn', 'btn-dark']]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('.btn').attr('disabled', 'disabled');
    });
});
</script>
@endsection
