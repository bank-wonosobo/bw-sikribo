<li class="nav-heading">SLIK</li>

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

@can('manajemen slik')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.slik.index') ? '' : 'collapsed' }}" href="{{ route('admin.permohonan-slik.index') }}">
    <i class='bx bxs-file-export'></i>
    <span>Data Permohohon SLIK</span>
    @if (App\Models\PermohonanSlik::where('status', 'PROSES PENGAJUAN')->orWhere('status', 'PROSES SLIK')->count() > 0)
        <span class="badge bg-danger ms-2">{{ App\Models\PermohonanSlik::where('status', 'PROSES PENGAJUAN')->orWhere('status', 'PROSES SLIK')->count() }}</span>
    @endif
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.slik.index') ? '' : 'collapsed' }}" href="{{ route('admin.slik.index') }}">
    <i class='bx bxs-file-export'></i>
    <span>Data SLIK</span>
    </a>
</li>
@endcan

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#hasil_slik" data-bs-toggle="collapse" href="#">
        <i class='bx bx-file'></i></i><span>Hasil SLIK</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="hasil_slik" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.hasil-slik.index') }}">
            <i class="bi bi-circle"></i><span>Hasil PDF</span>
        </a>
        @can('manajemen slik')
        <a href="{{ route('admin.hasil-slik.create') }}">
            <i class="bi bi-circle"></i><span>Upload Hasil</span>
        </a>
        @endcan
        </li>
    </ul>
</li>
