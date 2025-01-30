@extends('admin.templates.app')

@section('title', 'Histori Permohonan')

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
                        <th>Nomor Antrian</th>
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
                        <td>
                            <div class="sub-label">
                            @if (isset($permohonan->antrian->nomor_antrian))
                                Antrian ke- {{ $permohonan->antrian->nomor_antrian }}
                            @else
                                Tidak ada antrian
                            @endif

                            </div>
                        </td>
                        <td>
                            @if ($permohonan->sliks->count() == 0)
                                <span class="badge bg-warning">Belum Input Debitur</span>
                            @else
                                @foreach ($permohonan->sliks as $slik)
                                    <span class="badge bg-light text-black">{{ ucwords($slik->nama) }}  @if ($slik->status == 'SELESAI') <i class='bx bx-check'></i> @endif </span> <br>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <span class="badge @if ($permohonan->status == 'SELESAI') bg-success @elseif($permohonan->status == 'PROSES SLIK') bg-primary @else bg-light text-dark @endif">{{ ucwords($permohonan->status) }}</span>
                        </td>
                        <td>
                            @if ($permohonan->sliks->count() == 0)
                            <a class="btn btn-sm btn-warning text-white" href="{{ route('admin.slik.create', ['permohonan_slik_id' => $permohonan->id]) }}">Input Debitur</a>
                            @else
                            @if ($slik->status != 'SELESAI' && $slik->status != 'PROSES SLIK')
                            <a class="btn btn-sm btn-primary text-white" href="{{ route('admin.permohonan-slik.edit', ['id' => $permohonan->id]) }}">Edit Permohonan</a>
                            @endif
                            <a class="btn btn-sm btn-dark text-white" href="{{ route('admin.permohonan-slik.proccess', ['id' => $permohonan->id]) }}">Detail</a>
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

@section('style')
<style>
.sub-label {
    font-size: 12px;
    color: #767676;
}
</style>
@endsection
