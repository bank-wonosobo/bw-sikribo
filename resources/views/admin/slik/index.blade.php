@extends('admin.templates.app')

@section('title', 'Data SLIK')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Register SLIK</h5>
                <form method="GET" action="{{ route('admin.slik.index') }}" class="row g-2 mb-3">
                    <div class="col-md-6">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari no ref, NIK, nama, identitas, petugas, status"
                        >
                    </div>
                    <div class="col-md-2">
                        <select name="limit" class="form-select">
                            @foreach ([10, 25, 50, 100] as $option)
                                <option value="{{ $option }}" {{ (int) request('limit', 10) === $option ? 'selected' : '' }}>
                                    {{ $option }} / halaman
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.slik.index') }}" class="btn btn-light">Reset</a>
                    </div>
                </form>
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
                        @forelse ($sliks as $slik)
                        <tr>
                            <td>{{ $slik->no_ref_slik }}</td>
                            <td>{{ $slik->nik }}</td>
                            <td>{{ $slik->nama }}</td>
                            <td>{{ $slik->identitas_slik }}</td>
                            <td>{{ $slik->petugas_slik ?? '-' }}</td>
                            <td>
                                @if ($slik->status == 'SELESAI')
                                    <span class="badge bg-success">{{ $slik->status }}</span>
                                @elseif ($slik->status == 'PROSES SLIK')
                                    <span class="badge bg-light text-info">{{ $slik->status }}</span>
                                @else
                                    <span class="badge bg-light text-dark">{{ $slik->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($slik->status == 'PROSES PENGAJUAN')
                                    @can('selesai slik')
                                        <a href="{{ route('admin.slik.start-slik', ['id' => $slik->id]) }}" class="btn btn-sm btn-warning">Proses SLIK</a>
                                    @else
                                        <badge class="text-sm">Menunggu Proses Petugas</badge>
                                    @endcan

                                @elseif ($slik->status == "PROSES SLIK")
                                    @can('selesai slik')
                                        <a href="{{ route('admin.slik.done', ['id' => $slik->id]) }}" class="btn btn-sm btn-success">SELESAI</a>
                                    @else
                                        <badge class="text-sm">SLIK Sedang Diproses</badge>
                                    @endcan
                                @elseif ($slik->status == "SELESAI")
                                    <a href="{{ route('admin.hasil-slik.index') . '?nama=' . $slik->nama }}"><span class="badge text-dark">Lihat Hasil Slik</span></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $sliks->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
