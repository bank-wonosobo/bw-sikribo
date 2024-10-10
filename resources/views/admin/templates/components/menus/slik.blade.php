@can('permohonan_slik.read')
<li class="nav-heading">SLIK</li>
@endcan

@can('permohonan_slik.create')
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#permohonan_slik" data-bs-toggle="collapse" href="#">
        <i class='bx bx-file'></i></i><span>Permohonan SLIK</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="permohonan_slik" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.permohonan-slik.create') }}">
            <i class="bi bi-circle"></i><span>Permohonan SLIK</span>
        </a>
        <a href="{{ route('admin.permohonan-slik.history') }}">
            <i class="bi bi-circle"></i><span>Histori Permohonan</span>
        </a>
        </li>
    </ul>
</li>
@endcan

@can('permohonan_slik.proccess')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.slik.index') ? '' : 'collapsed' }}" href="{{ route('admin.permohonan-slik.index') }}">
    <i class='bx bxs-file-export'></i>
    <span>Data Permohohon SLIK</span>
    @if (App\Models\PermohonanSlik::where('status', 'PROSES PENGAJUAN')->orWhere('status', 'PROSES SLIK')->count() > 0)
        <span class="badge bg-danger ms-2">{{ App\Models\PermohonanSlik::where('status', 'PROSES PENGAJUAN')->orWhere('status', 'PROSES SLIK')->count() }}</span>
    @endif
    </a>
</li>
@endcan

@can('slik.read')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.slik.index') ? '' : 'collapsed' }}" href="{{ route('admin.slik.index') }}">
    <i class='bx bxs-file-export'></i>
    <span>Data SLIK</span>
    </a>
</li>
@endcan

@can('hasil_slik.read')
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#hasil_slik" data-bs-toggle="collapse" href="#">
        <i class='bx bx-file'></i></i><span>Hasil SLIK</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="hasil_slik" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.hasil-slik.index') }}">
            <i class="bi bi-circle"></i><span>Hasil PDF</span>
        </a>
        </li>
    </ul>
</li>
@endcan

@can('hasil_slik.create')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.slik.create') ? '' : 'collapsed' }}" href="{{ route('admin.hasil-slik.create') }}">
    <i class='bx bxs-file-export'></i>
    <span>Upload Hasil</span>
    </a>
</li>
@endcan
