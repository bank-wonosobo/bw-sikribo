@extends('admin.templates.app')

@section('title', 'Tagihan Kredit')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Tagihan</h5>
            <a href="{{ route('admin.kredit.create') }}" class="btn btn-sm btn-dark rounded-0">
            Tambah Data
            </a>

            <button type="button" class="btn btn-sm btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#importkredit">
                Import Data
            </button>


             <form action="" method="GET" class="mt-3">
                <div class="mb-3">
                    <label class="form-label">Pilih Bulan Jatuh Tempo</label>
                    <input type="month" name="year_month" class="form-control" value="{{ $_GET['year_month'] ?? Carbon\Carbon::now()->format('Y-m')}}">
                </div>

                <button type="submit" class="btn btn-dark rounded-0">Submit</button>
            </form>

            <div class="table-responsive">
            <!-- Table with stripped rows -->
            <table class="table datatable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Jumlah Tagihan</th>
                    <th>Jatuh Tempo</th>
                    <th>Nomer Rekenig</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @foreach ($bills as $bill)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $bill->customer->name }}</td>
                    <td>{{ $bill->amount_due }}</td>
                    <td>{{ $bill->due_date }}</td>
                    <td>{{ $bill->account_number }}</td>
                    <td>{{ $bill->status }}</td>
                    <td class="d-flex">
                    <a href="#" class="btn btn-sm btn-primary rounded-0">Terbayarkan</a>
                    <a href="" class="btn btn-sm btn-success rounded-0"><i class="bx bx-edit-alt me-1"></i></a>
                    <a href="" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Konfirmasi hapus data')"><i class="bx bx-trash me-1"></i></a>
                    {{-- <form method="POST" action="{{ route('admin.bill.delete', ['id' => $bill->id]) }}" onSubmit="return confirm('Do you want to delete?') ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm bg-white text-danger"><i class="fas fa-trash"></i></button>
                    </form> --}}
                    </td>
                </tr>
                @php($i++)
                @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@include('admin.bill.import')

@section('style')
<style>
.sub-label {
    font-size: 12px;
    color: #767676;
}
</style>
@endsection
