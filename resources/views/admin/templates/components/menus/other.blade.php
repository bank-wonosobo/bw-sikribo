
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
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="nav-link collapsed" href="{{ route('logout') }}">
    <i class="bi bi-box-arrow-right"></i>
    <span>Logout</span>
    </button>
    </form>
</li><!-- End Contact Page Nav -->
