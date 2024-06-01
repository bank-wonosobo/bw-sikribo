@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Histori Permohonan SLIK</h5>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomer SLIK</th>
                        <th>Peruntukan Ideb</th>
                        <th data-type="date" data-format="YYYY-MM-DD">Tanggal Pengajuan</th>
                        <th>Person</th>
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
                        <td>{{ $permohonan->peruntukan_ideb }}</td>
                        <td>{{ $permohonan->tanggal }}</td>
                        <td>
                            @if ($permohonan->sliks->count() == 0)
                                <span class="badge bg-danger">Belum Input Debitur</span>
                            @else
                                @foreach ($permohonan->sliks as $slik)
                                    <span class="badge bg-light text-black">{{ ucwords($slik->nama) }}</span><br>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $permohonan->status }}</span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info text-white" href="{{ route('admin.permohonan-slik.detail', ['id' => $permohonan->id]) }}">Detail</a>
                            <a class="btn btn-sm btn-warning text-white" href="{{ route('admin.permohonan-slik.detail', ['id' => $permohonan->id]) }}">Edit</a>
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
