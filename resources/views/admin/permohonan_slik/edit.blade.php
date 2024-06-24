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
                    </table>
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
                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
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
