@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Arsip Perjanjian Kredit</h5>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomer SLIK</th>
                        <th>Peruntukan Ideb</th>
                        <th data-type="date" data-format="YYYY-MM-DD">Tanggal Pengajuan</th>
                        <th>Pemohon</th>
                        <th>Status Pengajuan</th>
                        <th>Petugas SLIK</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach ($permohonan_slik as $permohonan)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $permohonan->nomor }}</td>
                        <td>{{ $permohonan->peruntukan_ideb }}</td>
                        <td>{{ $permohonan->tanggal }}</td>
                        <td>{{ $permohonan->pemohon }}</td>
                        <td>{{ $permohonan->status }}</td>
                        <td>{{ $permohonan->petugas_slik ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.permohonan-slik.detail', ['id' => $permohonan->id]) }}">detail</a>
                        </td>
                    </tr>
                    @php($i++)
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
