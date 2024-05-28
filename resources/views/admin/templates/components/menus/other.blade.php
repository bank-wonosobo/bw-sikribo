
<li class="nav-heading">Lain-lain</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bx bxs-cog"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.kode-slik.index') }}">
            <i class="bi bi-circle"></i><span>Set Kode SLIK</span>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.contact') ? '' : 'collapsed' }}" href="{{ route('admin.contact') }}">
    <i class="bi bi-envelope"></i>
    <span>Logout</span>
    </a>
</li><!-- End Contact Page Nav -->
