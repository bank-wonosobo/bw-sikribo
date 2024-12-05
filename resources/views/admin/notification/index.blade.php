@extends('admin.templates.app')

@section('title', 'Notifikasi')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kirim  Notifikasi</h5>
                <form method="POST" action="{{ route('admin.notifications.send') }}">
                    @csrf
                    <div class="table-responsive">
                    <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                </th>
                                <th>Nama Customer</th>
                                <th>Jumlah Tagihan</th>
                                <th>Jatuh Tempo</th>
                                <th>Nomer Rekenig</th>
                                <th>No Telpon</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bills as $bill)
                            <tr>
                                <td><input class="form-check-input" name="bill_ids[]" type="checkbox" value="{{ $bill->id }}"></td>
                                <td>{{ $bill->customer->name }}</td>
                                <td>{{ $bill->amount_due }}</td>
                                <td>{{ $bill->due_date }}</td>
                                <td>{{ $bill->account_number }}</td>
                                <td>{{ $bill->customer->phone }}</td>
                                <td>{{ $bill->status }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                    <button type="submit" class="btn btn-success rounded-0">Kirim Notifikasi</button>
                </form>
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

@section('script')
<script>
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.form-check-input');

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                selectAll.checked = false;
            } else if (Array.from(checkboxes).every(cb => cb.checked)) {
                selectAll.checked = true;
            }
        });
    });
</script>
@endsection
