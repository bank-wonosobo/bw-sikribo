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
                        <th data-type="date" data-format="YYYY-MM-DD">Tanggal Pengajuan</th>
                        <th>Pemohon</th>
                        <th>Status Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach ($permohonan_slik as $permohonan)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $permohonan->nomor }}</td>
                        <td>{{ $permohonan->tanggal }}</td>
                        <td>{{ $permohonan->pemohon }}</td>
                        <td>
                        @if ($permohonan->sliks->count() == 0)
                            <span class="badge bg-danger">Belum Input Debitur</span>
                        @else
                            <span class="badge @if ($permohonan->status != 'SELESAI') bg-light text-dark @else bg-success @endif">{{ ucwords($permohonan->status) }}</span>
                        @endif
                        </td>
                        <td>
                            @if ($permohonan->status != 'SELESAI')
                                @if ($permohonan->sliks->count() != 0)
                                    <a href="{{ route('admin.permohonan-slik.detail', ['id' => $permohonan->id]) }}" class="btn btn-dark">Slik</a>
                                @endif
                            @else
                                <a href="{{ route('admin.permohonan-slik.detail', ['id' => $permohonan->id]) }}" class="btn btn-light">Detail</a>
                            @endif
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
