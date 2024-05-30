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
        <a href="{{ route('admin.permohonan-slik.index') }}">
            <i class="bi bi-circle"></i><span>Data Permohonan</span>
        </a>
        <a href="{{ route('admin.permohonan-slik.history') }}">
            <i class="bi bi-circle"></i><span>Histori Permohonan</span>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
    <i class='bx bxs-file-export'></i>
    <span>Data SLIK</span>
    </a>
</li><!-- End F.A.Q Page Nav -->

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
    <i class='bx bx-file-find'></i>
    <span>Hasil SLIK</span>
    </a>
</li><!-- End F.A.Q Page Nav -->
