@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Permohonan Slik</h5>
                <a href="#" id="generateBatchSlik" class="btn btn-success">Generate Batch Slik</a>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomer SLIK</th>
                        <th>Antrian</th>
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
                        <td>
                            <div class="sub-label">
                            @if (isset($permohonan->antrian->nomor_antrian))
                                Antrian ke- {{ $permohonan->antrian->nomor_antrian }}
                            @else
                                Tidak ada antrian
                            @endif

                            </div>
                        </td>
                        <td>{{ $permohonan->pemohon }}</td>
                        <td>
                        @if ($permohonan->sliks->count() == 0)
                            <span class="badge bg-danger">Belum Input Debitur</span>
                        @else
                            <span class="badge @if ($permohonan->status == 'SELESAI') bg-success @elseif($permohonan->status == 'PROSES SLIK') bg-primary @else bg-light text-dark @endif">{{ ucwords($permohonan->status) }}</span>
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

@section('style')
<style>
.sub-label {
    font-size: 12px;
    color: #767676;
}
</style>
@endsection

@section("script")
<a href="#" id="generateBatchSlik" class="btn btn-success">Generate Batch Slik</a>

<script>
document.getElementById('generateBatchSlik').addEventListener('click', function (e) {
    e.preventDefault();

    const link = document.createElement('a');
    link.href = "{{ route('admin.slik.generate-doc') }}";
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();

    // Reload the page after a delay (adjust if needed)
    setTimeout(() => {
        window.location.reload();
    }, 500); // 3 seconds
});
</script>
@endsection
