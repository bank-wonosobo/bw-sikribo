@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
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
                        <td><span class="badge bg-primary">{{ $permohonan_slik->status }}</span></td>
                    </tr>
                    <tr>
                        <th>Petugas SLIK</th>
                        <td>:</td>
                        <td>{{ $permohonan_slik->petugas_slik ?? '-' }}</td>
                    </tr>
                </table>

                <h5 class="card-title mb-0">Data SLIK</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No Ref</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Identitas SLIK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permohonan_slik->sliks->sortBy('no_ref_slik') as $slik)
                        <tr>
                            <td>{{ $slik->no_ref_slik }}</td>
                            <td>{{ $slik->nik }}</td>
                            <td>{{ $slik->nama }}</td>
                            <td>{{ $slik->identitas_slik }}</td>
                            <td><span class="badge bg-primary">{{ $slik->status }}</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success">Ada</a>
                                <a href="#" class="btn btn-sm btn-danger">Tidak Ada</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="#" class="btn btn-primary mb-2">Selesai SLIK</a>

                <h5 class="card-title">Berkas SLIK</h5>
                <iframe src="{{ asset('storage' . $permohonan_slik->berkas) }}" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
