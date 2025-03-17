@extends('admin.templates.app')

@section('title', 'Permohonan SLIK')

@include('admin.templates.components.loader')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Permohonan SLIK</h4>

                <p>Masukan NIK dan Nama Identitas SLIK, minimal mengisi Debitur / Calon Debitur</p>

                <div class="alert alert-success" role="alert">
                No SLIK : <strong>{{ $permohonan_slik->nomor }}</strong>
                <br>
                Peruntukan Ideb : <strong>{{ $permohonan_slik->peruntukan_ideb }}</strong>
                <br>
                Berkas SLIK : <a href="{{ Storage::disk('s3')->url($permohonan_slik->berkas) }}" class="text-link" target="_blank">Lihat</a>
                </div>


                {!! Form::open(['route' => 'admin.slik.store', 'method' => 'POST', 'id' => 'slikForm']) !!}
                <input type="hidden" name="permohonan_slik_id" value="{{ $permohonan_slik->id }}" />
               <div class="row">
                    <div class="col-md-12">
                        <h6 class="card-title">Calon Slik Nasabah </h6>
                        <button type="button" class="btn btn-success mb-2" onclick="tambahPenjamin()">Tambah Calon Slik</button>
                        <div id="penjamin-container">
                            <div class="penjamin-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        {!! Form::label('nama[0]', 'Nama') !!}
                                        {!! Form::text('nama[0]', old('nama[0]'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::label('nik[0]', 'Nomer Identitas (NIK / NPWP)') !!}
                                        {!! Form::text('nik[0]', old('nik[0]'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::label('tanggal_lahir[0]', 'Tanggal Lahir') !!}
                                        {!! Form::date('tanggal_lahir[0]', old('tanggal_lahir[0]'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::label('identitas_slik[0]', 'Identitas SLIK') !!}
                                        {!! Form::select('identitas_slik[0]', [
                                            '' => '--- Pilih Identitas Slik ---',
                                            'Debitur/Calon Debitur' => 'Debitur/Calon Debitur',
                                            'Pasangan Debitur/Calon Debitur' => 'Pasangan Debitur/Calon Debitur',
                                            'Penjamin' => 'Penjamin',
                                            'Pasangan Penjamin' => 'Pasangan Penjamin',
                                            'Lainya' => 'Lainya'
                                        ], old('identitas_slik[0]'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end mt-2">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusPenjamin(this)"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="button" class="btn btn-dark" onclick="konfirmasiSubmit()">Ajukan Permohonan</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pengajuan SLIK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Silakan periksa kembali data yang Anda masukkan sebelum mengajukan permohonan. Pastikan <strong> (Nama, Nomer Identitas, Tanggal Lahir, Identitas SLik)</strong> sudah terisi.</p>
                <p>Pastikan semua data sudah benar. Jika ada kesalahan, silakan perbaiki terlebih dahulu.</p>
                <div class="alert alert-warning text-dark border-0 alert-dismissible fade show" role="alert">
                    <strong><i class='bx bx-info-circle text-danger me-2'></i></strong>Peringatan<br><br>
                    Apabila terdapat hasil slik yang tidak sesuai karena <strong>kesalahan input</strong> , petugas slik tidak akan mengulang kembali proses slik, oleh karena itu pastikan data yang diinput sudah benar.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
function getLastPenjaminIndex() {
    let inputs = document.querySelectorAll("[name^='nama[']");
    let lastIndex = -1;
    inputs.forEach(input => {
        let match = input.name.match(/\[(\d+)\]/);
        if (match) {
            let index = parseInt(match[1]);
            if (index > lastIndex) lastIndex = index;
        }
    });
    return lastIndex + 1;
}

function tambahPenjamin() {
    let container = document.getElementById("penjamin-container");
    let newIndex = getLastPenjaminIndex(); // Dapatkan index baru

    let newGroup = document.createElement("div");
    newGroup.classList.add("penjamin-group");
    newGroup.innerHTML = `
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="nama[${newIndex}]">Nama</label>
                <input type="text" name="nama[${newIndex}]" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="nik[${newIndex}]">Nomer Identitas (NIK / NPWP)</label>
                <input type="text" name="nik[${newIndex}]" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="tanggal_lahir[${newIndex}]">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir[${newIndex}]" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="identitas_slik[${newIndex}]">Identitas SLIK</label>
                <select name="identitas_slik[${newIndex}]" class="form-control">
                    <option value="">--- Pilih Identitas Slik ---</option>
                    <option value="Debitur/Calon Debitur">Debitur/Calon Debitur</option>
                    <option value="Pasangan Debitur/Calon Debitur">Pasangan Debitur/Calon Debitur</option>
                    <option value="Penjamin">Penjamin</option>
                    <option value="Pasangan Penjamin">Pasangan Penjamin</option>
                    <option value="Lainya">Lainya</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end mt-2">
                 <button type="button" class="btn btn-sm btn-danger" onclick="hapusPenjamin(this)"><i class="bi bi-trash"></i></button>
            </div>
        </div>
    `;

    container.appendChild(newGroup);
}

function konfirmasiSubmit() {
    let reviewList = document.getElementById("reviewList");


    let modal = new bootstrap.Modal(document.getElementById("konfirmasiModal"));
    modal.show();
}

function hapusPenjamin(element) {
    element.closest(".penjamin-group").remove();
}

function submitForm() {
    document.getElementById("slikForm").submit();
}
</script>
@endsection
