@extends('admin.templates.app')

@section('title', 'Tambah Arsip Pra Komite Kredit')

@include('admin.templates.components.loader')

@section('style')
<style>#the-canvas { width: 100%; outline: black 3px solid; }</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Arsip Pra Komite Kredit</h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                {!! Form::open(['route' => 'admin.pra-komite-kredit.store', 'method' => 'POST', 'files' => true]) !!}

                <div class="col-12">
                    {!! Form::label('nomor_register', 'Nomor Register', ['class' => 'form-label']) !!}
                    {!! Form::text('nomor_register', old('nomor_register'), ['class' => 'form-control']) !!}
                </div>

                <div class="col-12 mt-3">
                    {!! Form::label('kategori_id', 'Jenis Kredit', ['class' => 'form-label']) !!}
                    {!! Form::select('kategori_id', $kategori, null, ['class' => 'form-control', 'placeholder' => '=== Pilih Jenis Kredit ===']) !!}
                </div>

                <div class="col-12 mt-3">
                    {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                    {!! Form::select('status', $statuses, null, ['class' => 'form-control', 'placeholder' => '=== Pilih Status ===']) !!}
                </div>

                <h5 class="card-title mt-3">Berkas Kredit</h5>

                <div class="col-12">
                    {!! Form::label('file', 'File Berkas (PDF)', ['class' => 'form-label']) !!}
                    {!! Form::file('file', ['class' => 'form-control', 'id' => 'files', 'accept' => 'application/pdf']) !!}
                    <span class="text-danger text-small">* format pdf, dijadikan 1 file</span>
                </div>
                <div class="col-12 mt-2"><canvas id="the-canvas"></canvas></div>

                <div class="col-12 mt-4 d-flex gap-2">
                    {!! Form::submit('Simpan Data', ['class' => 'btn btn-dark']) !!}
                    <a href="{{ route('admin.pra-komite-kredit.index') }}" class="btn btn-light">Batal</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
<script>
document.getElementById('files').addEventListener('change', function(evt) {
    var file = evt.target.files[0];
    if (!file || file.type !== 'application/pdf') return;
    var reader = new FileReader();
    reader.onload = function(e) {
        pdfjsLib.getDocument(e.target.result).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                var canvas = document.getElementById('the-canvas');
                var viewport = page.getViewport({ scale: 1 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({ canvasContext: canvas.getContext('2d'), viewport: viewport });
            });
        });
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
