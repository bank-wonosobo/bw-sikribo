@extends('admin.templates.app')

@section('title', 'Arsip Jaminan/Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form id="generateSlikForm" method="POST" action="{{ route('admin.slik.generate-doc') }}">
            @csrf
            <div class="card-body">
                <h5 class="card-title">Data Permohonan Slik</h5>
                <button type="generateBatchSlik" id="generateBatchSlik" class="btn btn-success">Generate Batch Slik</button>
                <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table ">
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input" id="checkAll"></th>
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
                        <td>
                            @if ($permohonan->status == "PROSES PENGAJUAN")
                                <input type="checkbox" name="permohonan_ids[]" value="{{ $permohonan->id }}" class="form-check-input child-checkbox">
                            @endif

                        </td>
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
            </form>
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
<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.child-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

      // Reload the page after a delay (adjust if needed)
   // 3 seconds
// document.getElementById('generateBatchSlik').addEventListener('click', function (e) {
//     e.preventDefault();

//     const link = document.createElement('a');
//     link.href = "{{ route('admin.slik.generate-doc') }}";
//     link.style.display = 'none';
//     document.body.appendChild(link);
//     link.click();

//     // Reload the page after a delay (adjust if needed)
//     setTimeout(() => {
//         window.location.reload();
//     }, 500); // 3 seconds
// });

document.getElementById('generateBatchSlik').addEventListener('click', async function () {
    const checkboxes = document.querySelectorAll('.child-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Silakan pilih minimal satu permohonan!');
        return;
    }

    const formData = new FormData();
    checkboxes.forEach(checkbox => {
        formData.append('permohonan_ids[]', checkbox.value);
    });

    // Tambahkan CSRF token
    formData.append('_token', '{{ csrf_token() }}');

    try {
        const response = await fetch("{{ route('admin.slik.generate-doc') }}", {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) throw new Error('Download gagal');

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;

        // Buat nama file dari header 'Content-Disposition'
        const contentDisposition = response.headers.get('Content-Disposition');
        let fileName = "batch_slik.txt";
        if (contentDisposition && contentDisposition.includes("filename=")) {
            fileName = contentDisposition.split("filename=")[1].replace(/"/g, '');
        }

        a.download = fileName;
        document.body.appendChild(a);
        a.click();
        a.remove();

        // Tunggu 1 detik lalu reload
        setTimeout(() => {
            location.reload();
        }, 700);
    } catch (error) {
        alert('Terjadi kesalahan saat mengunduh file.');
        console.error(error);
    }
});

</script>
@endsection
