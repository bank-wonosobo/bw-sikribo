@extends('admin.templates.app')

@section('title', 'Tambah Arsip Perjanjian Kredit')

@include('admin.templates.components.loader')

@section('style')
<style>
#the-canvas {
    width: 100%;
    outline: black 3px solid;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Perjanjian Kredit</h5>

                {!! Form::open(['route' => 'admin.kredit.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="col-12">
                    {!! Form::label('no_kredit', 'Nomer Kredit', ['class' => 'form-label']) !!}
                    {!! Form::text('no_kredit', old('no_kredit') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('nama_peminjam', 'Nama Peminjam', ['class' => 'form-label']) !!}
                    {!! Form::text('nama_peminjam', old('nama_peminjam') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('tanggal_akad', 'Tanggal Akad', ['class' => 'form-label']) !!}
                    {!! Form::date('tanggal_akad', old('tanggal_akad') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('kategori_id', 'Kategori Kredit', ['class' => 'form-label']) !!}
                    {!! Form::select('kategori_id', $kategori, null, ['class' => 'form-control', 'placeholder','placeholder' => '=== Pilih kategori ===']) !!}
                </div>

                <div class="col-12 mt-3">
                    {!! Form::label('status_pengikatan', 'Status Pengikatan', ['class' => 'form-label']) !!}
                    {!! Form::select('status_pengikatan', ["SELESAI"=> "Selesai", "BELUM SELESAI" => "Belum Selesai"], null, ['class' => 'form-control', 'placeholder','placeholder' => '=== Status Pengikatan ===']) !!}
                </div>

                <h5 class="card-title mt-3">Jaminan</h5>

                <div class="col-12">
                    {!! Form::label('no_jaminan', 'Nomer Jaminan', ['class' => 'form-label']) !!}
                    {!! Form::text('no_jaminan', old('no_jaminan') ,['class' => 'form-control']) !!}
                </div>
                <div class="col-12 mt-3">
                    {!! Form::label('jenis_jaminan_id', 'Jenis Jaminan', ['class' => 'form-label']) !!}
                    {!! Form::select('jenis_jaminan_id', $jenis_jaminan, null, ['class' => 'form-control', 'placeholder','placeholder' => '=== Pilih Jenis Jaminan ===']) !!}
                </div>

                <h5 class="card-title mt-3">Berkas</h5>

                <div class="col-12">
                    {!! Form::label('file', 'File Kredit', ['class' => 'form-label']) !!}
                    {!! Form::file('file' ,['class' => 'form-control', 'id' => 'files']) !!}
                    <span class="text-danger text-small">* berkas dengan format pdf, dijadikan 1 file</span>
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
                {!! Form::submit('Input Data', ['class' => ['btn', 'btn-dark']]) !!}
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
          var scale = 1;
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
