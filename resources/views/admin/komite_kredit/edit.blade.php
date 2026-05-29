@extends('admin.templates.app')

@section('title', 'Edit Arsip Komite Kredit')

@include('admin.templates.components.loader')

@section('style')
<style>#the-canvas { width: 100%; outline: black 3px solid; }</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Arsip Komite Kredit</h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                {!! Form::open(['route' => ['admin.komite-kredit.update', $record->id], 'method' => 'PUT', 'files' => true]) !!}

                <div class="col-12">
                    {!! Form::label('nomor_register', 'Nomor Register', ['class' => 'form-label']) !!}
                    {!! Form::text('nomor_register', old('nomor_register', $record->nomor_register), ['class' => 'form-control']) !!}
                </div>

                <div class="col-12 mt-3">
                    {!! Form::label('kategori_id', 'Jenis Kredit', ['class' => 'form-label']) !!}
                    {!! Form::select('kategori_id', $kategori, old('kategori_id', $record->kategori_id), ['class' => 'form-control', 'placeholder' => '=== Pilih Jenis Kredit ===']) !!}
                </div>

                <div class="col-12 mt-3">
                    {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                    {!! Form::select('status', $statuses, old('status', $record->status), ['class' => 'form-control', 'placeholder' => '=== Pilih Status ===']) !!}
                </div>

                <h5 class="card-title mt-3">Berkas Kredit</h5>

                @if($record->file)
                    <div class="col-12 mb-2">
                        <a href="{{ route('admin.komite-kredit.file', $record->id) }}" target="_blank" class="btn btn-sm btn-light">
                            <i class='bx bxs-file-pdf'></i> Lihat Berkas Saat Ini
                        </a>
                    </div>
                @endif

                <div class="col-12">
                    {!! Form::label('file', 'Ganti Berkas (PDF, opsional)', ['class' => 'form-label']) !!}
                    {!! Form::file('file', ['class' => 'form-control', 'id' => 'files', 'accept' => 'application/pdf']) !!}
                </div>
                <div class="col-12 mt-2"><canvas id="the-canvas"></canvas></div>

                <div class="col-12 mt-4 d-flex gap-2">
                    {!! Form::submit('Perbarui Data', ['class' => 'btn btn-dark']) !!}
                    <a href="{{ route('admin.komite-kredit.index') }}" class="btn btn-light">Batal</a>
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
