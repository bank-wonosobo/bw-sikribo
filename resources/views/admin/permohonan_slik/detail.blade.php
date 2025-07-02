@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.permohonan-slik.index') }}" class="btn btn-light rounded-0 mt-3"><strong><i class='bx bx-chevron-left'></i> Kembali</strong></a>
                <h5 class="card-title">Detail Permohonan SLIK</h5>
                <table class="table">
                    <tr>
                        <th>Nomer SLIK</th>
                        <td>:</td>
                        <td>{{ $permohonan_slik->nomor }}</td>
                    </tr>
                    <tr>
                        <th>Pemohon</th>
                        <td>:</td>
                        <td>{{ $permohonan_slik->pemohon }}</td>
                    </tr>
                    <tr>
                        <th>Peruntukan Ideb</th>
                        <td>:</td>
                        <td>{{ $permohonan_slik->peruntukan_ideb }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td>:</td>
                        <td>{{ $permohonan_slik->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Status Pengajuan</th>
                        <td>:</td>
                        <td>
                            <span class="badge @if ($permohonan_slik->status != 'SELESAI') bg-light text-dark @else bg-success @endif">{{ $permohonan_slik->status }}</span>
                        </td>
                    </tr>
                </table>
                <div class="d-flex w-100 gap-2">
                    <form method="POST" action="{{ route('admin.permohonan-slik.reject', ['id' => $permohonan_slik->id]) }}">
                        @csrf
                        <button class="btn btn-danger mb-2 @if($permohonan_slik->status != "PROSES PENGAJUAN") disabled @endif">Tolak Permohonan</button>
                    </form>
                    <form method="POST" action="{{ route('admin.permohonan-slik.done', ['id' => $permohonan_slik->id]) }}">
                        @csrf
                        <button class="btn btn-success mb-2">Selesai Slik</button>
                    </form>
                </div>


                <h5 class="card-title mb-0">Data SLIK</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No Ref</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            {{-- <th>Identitas SLIK</th> --}}
                            <th>Tanggal Lahir</th>
                            <th>Petugas Slik</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permohonan_slik->sliks->sortBy('created_at') as $index => $slik)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm" onclick="copyText('noRef{{ $index }}')"><i class="bi bi-copy"></i></button>
                                    <input type="text" class="border-0" disabled value="{{ $slik->no_ref_slik }}" id="noRef{{ $index }}">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                     <button class="btn btn-sm"  onclick="copyText('nik{{ $index }}')"><i class="bi bi-copy"></i></button>
                                    <input type="text" disabled class="border-0"  value="{{ $slik->nik }}" id="nik{{ $index }}">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm"  onclick="copyText('nama{{ $index }}')"><i class="bi bi-copy"></i></button>
                                    <input type="text" disabled class="border-0"  value="{{ $slik->nama }}" id="nama{{ $index }}">
                                </div>
                            </td>
                            {{-- <td>{{ $slik->identitas_slik }}</td> --}}
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm"  onclick="copyText('tanggal_lahir{{ $index }}')"><i class="bi bi-copy"></i></button>
                                    <input type="text" disabled class="border-0"  value="{{ \Carbon\Carbon::parse($slik->tanggal_lahir)->format('d-m-Y') }}" id="tanggal_lahir{{ $index }}">
                                </div>
                            </td>
                            <td>{{ $slik->petugas_slik ?? '-' }}</td>

                            {{-- <td>
                                @if ($slik->status == 'PROSES PENGAJUAN')
                                    @can('selesai slik')
                                        <a href="{{ route('admin.slik.start-slik', ['id' => $slik->id]) }}" class="btn btn-sm btn-warning">Proses SLIK</a>
                                    @else
                                        <span class="text-xs">Menunggu Proses Petugas</span>
                                    @endcan
                                @elseif ($slik->status == "PROSES SLIK")
                                    @can('selesai slik')
                                        <a href="{{ route('admin.slik.done', ['id' => $slik->id]) }}" class="btn btn-sm btn-primary">SELESAI SLIK</a>
                                    @else
                                        <span class="text-sm">SLIK Sedang Diproses</span>
                                    @endcan
                                @elseif ($slik->status == "SELESAI")
                                    <a href="{{ route('admin.hasil-slik.index') . '?nama=' . $slik->nama }}"><span class="badge text-dark">Lihat Hasil Slik</span></a>
                                @endif
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                @can('selesai slik')
                <h4 class="card-title">Upload Hasil SLIK</h4>
                <form id="id_dropzone" class="dropzone" action="{{ route('admin.hasil-slik.store') }}" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="permohonan_slik_id" value="{{ $permohonan_slik->id }}" />
                    @csrf
                </form>
                @endcan

                <h4 class="card-title">Hasil SLIK</h4>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th data-type="date" data-format="YYYY-MM-DD hh:mm:ss">Created At</th>
                        <th>File</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach ($hasil_slik as $hasil)
                    <a>
                    <tr>
                        <td>{{ $i }}</td>
                        <td><a href="{{ Storage::disk('s3')->url($hasil->file) }}" class="btn" target="_blank">{{ $hasil->nama }}</a></td>
                        <td>{{ $hasil->created_at }}</td>
                        <td><a href="{{ Storage::disk('s3')->url($hasil->file) }}" class="btn btn-dark" target="_blank"><i class='bx bxs-download'></i></a></td>
                        </td>
                    </tr>
                    </a>

                    @php($i++)
                    @endforeach
                    </tbody>
                </table>
                </div>
                <h5 class="card-title ">Berkas SLIK</h5>
                <iframe src="{{ Storage::disk('s3')->url($permohonan_slik->berkas) }}" width="100%" height="700px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection

@section('script')
<script type="text/javascript">
  Dropzone.autoDiscover = true;

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

  function copyText(id) {
        var copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Untuk mobile

        navigator.clipboard.writeText(copyText.value);
        // alert("Copied: " + copyText.value);
    }
</script>
@endsection

