@extends('admin.templates.app')

@section('title', 'Permohonan SLIK')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="alert alert-warning text-dark border-0 alert-dismissible fade show" role="alert">
            <strong><i class='bx bx-info-circle text-danger me-2'></i></strong>Peringatan<br><br>
            Cek kembali history permohonan, apabila terdapat permohonan yang <strong>belum terinput debitur </strong>, silahkan lengkapi permohonan tersebut sebelum melakukan permohonan slik.
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Permohonan SLIK</h5>
                <div class="alert bg-light text-dark border-0 alert-dismissible fade show" role="alert">
                    @if ($kode_slik == null)
                        <p class="text-warning">User belum <a href="{{ route('admin.kode-slik.index') }}" class="alert-link">Atur Kode SLIK</a>. atur kode SLIK untuk dapat melakukan permohonan SLIK</p>
                    @else
                        Kode SLIK : <strong>{{ $kode_slik->kode }}</strong>
                        <br><br>
                        <strong><i class='bx bx-info-circle text-primary me-2'></i></strong>Peringatan<br><br>
                        Apabila pemohon tidak melengkapi isi berkas sesuai dengan ketentuan, petugas SLIK berhak menolak permohonan SLIK
                    @endif
                </div>

                <p>Masukan Nomor SLIK dan Peruntukan Ideb untuk permohonan SLIK</p>
                {!! Form::open(['route' => 'admin.permohonan-slik.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="col-12 mt-3">
                    {!! Form::label('peruntukan_ideb', 'Peruntukan Ideb') !!}
                    {!! Form::text('peruntukan_ideb', old('peruntukan_ideb') ,['class' => 'form-control', 'placeholder' => 'ex: Permohonan SLIK']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('berkas', 'Berkas SLIK', ['class' => 'font-weight-bold']) !!}
                    {!! Form::file('berkas' ,['class' => 'form-control']) !!}
                    <span class="text-danger text-small">* berkas berisi KTP dan KK dengan format pdf, dan foto nomer register kredit, dijadikan 1 file</span>
                </div>
                <div class="col-12 mt-4">
                    {!! Form::submit('Buat Permohonan', ['class' => ['btn', 'btn-dark' , 'btn-sm', 'rounded-0']]) !!}
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
