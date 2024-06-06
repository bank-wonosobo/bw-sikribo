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
                        <td>
                            <span class="badge @if ($permohonan_slik->status != 'SELESAI') bg-light text-dark @else bg-success @endif">{{ $permohonan_slik->status }}</span>
                        </td>
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
                            <th>Petugas Slik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permohonan_slik->sliks->sortBy('created_at') as $slik)
                        <tr>
                            <td>{{ $slik->no_ref_slik }}</td>
                            <td>{{ $slik->nik }}</td>
                            <td>{{ $slik->nama }}</td>
                            <td>{{ $slik->identitas_slik }}</td>
                            <td>{{ $slik->petugas_slik ?? '-' }}</td>
                            <td>
                                @if ($slik->status != 'SELESAI')
                                    <span class="badge bg-light text-dark">{{ $slik->status }}</span>
                                @else
                                    <span class="badge bg-success">{{ $slik->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($slik->status != 'SELESAI')
                                    @can('selesai slik')
                                        <a href="{{ route('admin.slik.done', ['id' => $slik->id]) }}" class="btn btn-sm btn-success">Selesai</a>
                                    @else
                                        <badge class="text-sm">Menunggu Proses Petugas</badge>
                                    @endcan
                                @else
                                    <a href="{{ route('admin.hasil-slik.index') . '?nama=' . $slik->nama }}"><span class="badge text-dark">Lihat Hasil Slik</span></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h5 class="card-title">Berkas SLIK</h5>
                <iframe src="{{ asset('storage' . $permohonan_slik->berkas) }}" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
