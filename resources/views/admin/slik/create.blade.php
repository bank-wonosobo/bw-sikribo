@extends('admin.templates.app')

@section('title', 'Homestay')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Foto Homestay</li>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Upload Foto Homestay</h4>
        <form id="id_dropzone" class="dropzone" action="{{ route('admin.slik.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        </form>
        <a href="{{ route('admin.slik.create') }}" class="btn btn-dark mt-2">Selesai Upload</a>
        </div>
    </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  Dropzone.autoDiscover = false;

  $(document).ready(function () {
      $("#id_dropzone").dropzone({
        maxFilesize: 5,
        // renameFile: function(file) {
        //   var dt = new Date()
        //   var time = dt.getTime()
        //   var splitname = file.name.split('.')
        //   return time+'.'+ splitname.pop()
        // },
        acceptedFiles: ".pdf",
        addRemoveLinks: true,
        timeout: 50000,
        addRemoveLinks: false,
        success: function(file, response)
        {
            console.log("success upload");
            $(file.previewElement).addClass("dz-success").find('.dz-success-message').text(response);

        },
        error: function(file, response)
        {
            console.log("failed upload");

            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);
        }
      });
  })
</script>
@endsection
