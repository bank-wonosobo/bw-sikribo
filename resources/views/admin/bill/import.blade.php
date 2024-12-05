<div class="modal fade" id="importkredit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import Data Tagihan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['route' => 'admin.bills.import', 'method' => 'POST', 'files' => true]) !!}
        <div class="modal-body">
                <a href="{{ asset('template-import/SIKRIBO - Template Import Data Arsip Kredit.xlsx') }}" class="btn btn-sm btn-success rounded-0">Download Template</a>
                <div class="col-12 mt-3">
                    {!! Form::label('file', 'File', ['class' => 'form-label']) !!}
                    {!! Form::file('file' ,['class' => 'form-control', 'id' => 'files']) !!}
                    <span class="text-sm">* Download template untuk dapat mengimpor data mahasiswa dengan menggunakan file .xlsx</span>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success rounded-0">Import</button>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
