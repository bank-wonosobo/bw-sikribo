@extends('admin.templates.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Terimakasih telah melakukan permohonan SLIK</h5>
                <div class="alert bg-light text-dark border-0 alert-dismissible fade show" role="alert">
                    <strong><i class='bx bx-info-circle text-primary me-2'></i></strong>Peringatan<br><br>
                    <p>Apabila terdapat berkas yang tidak sesuai, petugas slik berhak menolak permohonan slik. Dan pastiksan mengisi data minimal debitur dalam permohonan SLIK. </p>
                </div>

                <h5 class="card-title text-center mb-5">Aktivitas Terbaru</h5>
                <div class="progress-container px-4">
                    <div class="step">
                        @if ($permohonan_slik->status == 'BELUM INPUT DEBITUR')
                            <div class="icon text-warning"><i class='bx bxs-info-circle'></i></div>
                        @else
                            <div class="icon text-success"><i class='bx bxs-check-circle'></i></div>
                        @endif
                        <div class="label">Upload</div>
                    </div>
                    <div class="progress">
                        @if ($permohonan_slik->status == 'BELUM INPUT DEBITUR')
                            <div class="progress-bar bg-danger" style="width: 50%;"></div>
                        @else
                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                        @endif
                        {{-- <div class="progress-bar bg-primary progress-bar-review" style="width: 40%;"></div> --}}
                    </div>
                    <div class="step mx-4">
                        <div class="icon text-primary"><i class='bx bx-stopwatch'></i></div>
                        <div class="label">Menunggu proses slik</div>
                        <div class="sub-label">Antrian ke- {{ $antrian_permohonan->nomor_antrian ?? 'x'}}</div>
                    </div>
                    <div class="progress">
                        @if ($permohonan_slik->status == 'SELESAI')
                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                        @elseif ($permohonan_slik->status == 'TOLAK')
                            <div class="progress-bar bg-danger" style="width: 100%;"></div>
                        @else
                            <div class="progress-bar progress-bar-submission" style="width: 0%;"></div>
                        @endif
                    </div>
                    <div class="step">
                        @if ($permohonan_slik->status == 'SELESAI')
                            <div class="icon"><i class='bx bxs-check-circle text-success'></i></div>
                            <div class="label">Sukses</div>
                        @elseif ($permohonan_slik->status == 'TOLAK')
                            <div class="icon"><i class='bx bxs-info-circle text-danger'></i></div>
                            <div class="label">Permohonan Ditolak</div>
                        @else
                            <div class="icon"><i class='bx bx-circle text-black-50'></i></div>
                            <div class="label">Hasil SLIK</div>
                        @endif
                    </div>
                </div>

                @if ($permohonan_slik->status == 'TOLAK')
                <h5 class="card-title mt-5"><i class='icon text-primary bx bx-stopwatch'></i> Upload Berkas Ulang</h5>
                {!! Form::open(['route' => 'admin.permohonan-slik.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="col-6 mt-3">
                    {!! Form::label('berkas', 'Berkas SLIK', ['class' => 'font-weight-bold']) !!}
                    {!! Form::file('berkas' ,['class' => 'form-control']) !!}
                    <span class="text-danger text-small">* berkas berisi KTP dan KK dengan format pdf, dan foto nomer register kredit, dijadikan 1 file</span>
                </div>
                <div class="col-6 mt-4">
                    {!! Form::submit('Upload Berkas', ['class' => ['btn', 'btn-dark' , 'btn-sm', 'rounded-0']]) !!}
                </div>
                {!! Form::close() !!}
                @endif
                <h5 class="card-title mt-5"><i class='icon text-primary bx bx-stopwatch'></i> Person SLIK</h5>
                @if ($permohonan_slik->status == 'BELUM INPUT DEBITUR')
                <div class="alert bg-light text-dark border-0 alert-dismissible fade show" role="alert">
                    <strong><i class='bx bx-info-circle text-warning me-2'></i></strong>Peringatan<br><br>
                    <p>Anda belum input data dabitur pada pengajuan ini, silahkan input debitur telebih dahulu</p>
                    <a href="{{ route('admin.slik.create', ['permohonan_slik_id' => $permohonan_slik->id]) }}" class="btn rounded-0 btn-sm btn-dark">Input Debitur</a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Petugas Slik</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permohonan_slik->sliks->sortBy('created_at') as $slik)
                        <tr>
                            <td>
                                <span class="ps-2">{{ $slik->nama }}</span><br>
                                <div class="badge badge-sm text-black-50">{{ $slik->identitas_slik }}</div>
                            </td>
                            <td>
                                @if ($slik->status == 'SELESAI')
                                    <span class="badge bg-success">{{ $slik->status }}</span>
                                @elseif ($slik->status == 'PROSES SLIK')
                                    <span class="badge bg-light text-info">{{ $slik->status }}</span>
                                @else
                                    <span class="badge bg-light  text-dark">{{ $slik->status }}</span>
                                @endif
                            </td>
                            <td>{{ $slik->petugas_slik ?? '-' }}</td>
                            <td>
                                @if ($slik->status == "SELESAI")
                                    <a href="{{ route('admin.hasil-slik.index') . '?nama=' . $slik->nama }}"><span class="badge text-dark">Lihat Hasil Slik</span></a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="d-flex justify-content-center mt-5 flex-wrap">
                    <a href="{{ route('admin.permohonan-slik.history') }}" class="btn btn-sm rounded-0 btn-dark mt-3">Lihat Histori Permohonan</a>
                    <a href="{{ route('admin.permohonan-slik.create') }}" class="btn btn-dark btn-sm rounded-0 ms-lg-4 mt-3">Ajukan Permohonan SLIK</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .custom-icon {
        font-size: 25px;
    }

    .progress-container {
        display: flex;
        align-items: center;
    }
    .progress-container .step {
        text-align: center;
        flex: 1;
    }
    .progress-container .step .icon {
        font-size: 24px;
        margin-bottom: 5px;
    }
    .progress-container .step .label {
        font-size: 14px;
        color: #555;
    }
    .progress-container .step .sub-label {
        font-size: 12px;
        color: #999;
    }
    .progress-container .progress {
        height: 5px;
        flex: 3;
    }
        /* .progress-container .progress-bar {
            background-color: #28a745;
        }
        .progress-container .progress-bar-review {
            background-color: #007bff;
        }
        .progress-container .progress-bar-submission {
            background-color: #6c757d;
        } */
</style>
@endsection
