@extends('admin.templates.app')

@section('title', 'Permohonan SLIK')

@section('style')
<style>
#the-canvas {
  outline: black 3px solid;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Dokumen Hukum</h5>

                {!! Form::open(['route' => 'admin.dokumen-hukum.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="col-12 mt-3">
                    {!! Form::label('nomor', 'Nomor') !!}
                    {!! Form::text('nomor', old('nomor') ,['class' => 'form-control', 'placeholder' => 'ex: Permohonan SLIK']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('perihal', 'perihal') !!}
                    {!! Form::text('perihal', old('perihal') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('tanggal', 'tanggal') !!}
                    {!! Form::date('tanggal', old('tanggal') ?? Carbon\Carbon::now() ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('tahun', 'tahun') !!}
                    {!! Form::number('tahun',  old('tahun') ?? Carbon\Carbon::now()->year ,['class' => 'form-control', 'placeholder' => 'YYYY',  'min' => "2000",  'max'=>"2100"]) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('keterangan', 'keterangan') !!}
                    {!! Form::text('keterangan', old('tanggal') ,['class' => 'form-control', 'placeholder' => 'ex: Permohonan SLIK']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', ['Berlaku', 'Tidak Berlaku'], old('status'), ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('jenis_dokumen_hukum_id', 'Jenis Dokumen') !!}
                    {!! Form::select('jenis_dokumen_hukum_id', $jenis_dh, old('status'), ['class' => 'form-control', 'placeholder','placeholder' => 'Pilih kategori...']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('berkas', 'Berkas SLIK', ['class' => 'font-weight-bold']) !!}
                    {!! Form::file('file' ,['class' => 'form-control', 'id' => 'files']) !!}
                    <span class="text-danger text-small">* berkas berisi KTP dan KK dengan format pdf, dijadikan 1 file</span>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <h6>Preview Dukumen</h6>
                            <div class="backdrop">
                                <div class="highlights">

                                </div>
                            </div>
                            <canvas id="the-canvas"></canvas>
                        </div>
                    </div>
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
document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
<script>
const PDF_TYPE = "application/pdf";
const TXT_TYPE = "text/plain";

document.getElementById('files').addEventListener('change', handleFileSelect, false);


function handleFileSelect(evt) {
  var files = evt.target.files; // FileList object
  for (var i = 0, f; f = files[i]; i++) {
    let fileType = files[i].type;
    if (fileType === PDF_TYPE) {
      handlePDFFile(files[i]);
    } else if (fileType === TXT_TYPE) {
      handleTxtFile(files[i])
    } else {
      console.error(`cannot handle file type: ${fileType}`)
    }
  }
}

function handleTxtFile(file) {
  var reader = new FileReader();
  reader.onload = (function(reader) {
    return function() {
      var contents = reader.result;
      var lines = contents.split('\n');

      document.getElementById('container').innerHTML = contents;
    }
  })(reader);

  reader.readAsText(file);
}

function handlePDFFile(file) {
  var reader = new FileReader();

  reader.onload = (function(reader) {
    return function() {
      var contents = reader.result;
      var loadingTask = pdfjsLib.getDocument(contents);

      loadingTask.promise.then(function(pdf) {
        pdf.getPage(1).then(function(page) {
          var scale = 0.7;
          var viewport = page.getViewport({
            scale: scale,
          });

          var canvas = document.getElementById('the-canvas');
          var context = canvas.getContext('2d');
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          var renderContext = {
            canvasContext: context,
            viewport: viewport
          };
          page.render(renderContext);
        });
      });
    }
  })(reader);
  reader.readAsDataURL(file);
}
</script>
@endsection
