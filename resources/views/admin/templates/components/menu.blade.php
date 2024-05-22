<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ Route::is('admin.dashboard.*') ? '' : 'collapsed' }}" href="index.html">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Arsip Kredit</li>

    <li class="nav-item">
      <a href="{{ route('admin.kredit.index') }}" class="nav-link {{ Route::is('admin.kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-file-find'></i>
        <span>Arsip Perjanjian Kredit</span>
      </a>
    </li><!-- End Profile Page Nav -->

    @can('kategorikredit:manage')
    <li class="nav-item">
      <a href="{{ route('admin.kategori-kredit.index') }}" class="nav-link {{ Route::is('admin.kategori-kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-credit-card-front'></i>
        <span>Jenis Kredit</span>
      </a>
    </li>
    @endcan

    @can('slik:manage')

    <li class="nav-heading">SLIK</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#permohonan_slik" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-cog"></i><span>Permohonan SLIK</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="permohonan_slik" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.permohonan-slik.create') }}">
              <i class="bi bi-circle"></i><span>Permohonan SLIK</span>
            </a>
            <a href="{{ route('admin.permohonan-slik.index') }}">
              <i class="bi bi-circle"></i><span>Data Permohonan</span>
            </a>
            <a href="{{ route('admin.kode-slik.index') }}">
              <i class="bi bi-circle"></i><span>Histori Permohonan</span>
            </a>
          </li>
        </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
        <i class="bi bi-question-circle"></i>
        <span>Data SLIK</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    @endcan
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
      <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link {{ Route::is('admin.contact') ? '' : 'collapsed' }}" href="{{ route('admin.contact') }}">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->
  </ul>
