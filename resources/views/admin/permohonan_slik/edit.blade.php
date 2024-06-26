@extends('admin.templates.app')

@section('title', 'Edit Permohonan SLIK')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
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
                            <td>{{ $permohonan_slik->tanggal }}</td>
                        </tr>
                        <tr>
                            <th>Status Pengajuan</th>
                            <td>:</td>
                            <td>
                                <span class="badge @if ($permohonan_slik->status != 'SELESAI') bg-light text-dark @else bg-success @endif">{{ $permohonan_slik->status }}</span>
                            </td>
                        </tr>
                         <tr>
                            <th>Berkas</th>
                            <td>:</td>
                            <td>
                                <a href="{{ asset('storage' . $permohonan_slik->berkas) }}" class="btn btn-dark" target="_blank"><i class='bx bxs-download'></i></a>
                            </td>
                        </tr>
                    </table>

                    <h5 class="card-title">Upload Ulang Berkas</h5>
                    {!! Form::open(['route' => ['admin.permohonan-slik.update-berkas', 'id' => $permohonan_slik->id], 'method' => 'POST', 'files' => true]) !!}
                    <div class="col-12 mt-3">
                        {!! Form::label('berkas', 'Berkas SLIK', ['class' => 'font-weight-bold']) !!}
                        {!! Form::file('berkas' ,['class' => 'form-control']) !!}
                        <span class="text-danger text-small">* berkas berisi KTP dan KK dengan format pdf, dan foto nomer register kredit, dijadikan 1 file</span>
                    </div>
                    <div class="col-12 mt-4">
                        {!! Form::submit('Update Berkas', ['class' => ['btn', 'btn-dark', 'rounded-0', 'btn-sm']]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Debitur</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Identitas SLIK</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permohonan_slik->sliks->sortBy('created_at') as $slik)
                            <tr>
                                <td>{{ $slik->nik }}</td>
                                <td>{{ $slik->nama }}</td>
                                <td>{{ $slik->identitas_slik }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-dark rounded-0" data-bs-toggle="modal" data-bs-target="#basicModal">Edit</button>
                                    @include('admin.permohonan_slik.edit-slik')
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
