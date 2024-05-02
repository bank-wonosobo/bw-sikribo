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

    <li class="nav-heading">SLIK</li>

    <li class="nav-item">
      <a class="nav-link {{ Route::is('admin.slik.index') ? '' : 'collapsed' }}" href="{{ route('admin.slik.index') }}">
       <i class='bx bx-copy-alt'></i>
        <span>Data SLIK</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    @can('slik:manage')
    <li class="nav-item">
      <a class="nav-link {{ Route::is('admin.slik.create') ? '' : 'collapsed' }}" href="{{ route('admin.slik.create') }}">
        <i class='bx bx-add-to-queue'></i>
        <span>Tambah SLIK</span>
      </a>
    </li>
    @endcan
    <li class="nav-heading">Lain-lain</li>

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

{{-- <!-- Nav Item - Dashboard -->
<li class="nav-item {{ Route::is('admin.dashboard.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Arsip Kredit
</div>

<!-- Nav Item - Tables -->
<li class="nav-item {{ Route::is('admin.kredit.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.kredit.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Arsip Perjanjian Kedit</span></a>
</li>
@can('kategorikredit:manage')
<li class="nav-item {{ Route::is('admin.kategori-kredit.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.kategori-kredit.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Kategori Kredit</span></a>
</li>
@endcan --}}

<!-- Nav Item - Pages Collapse Menu -->
{{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
        </div>
    </div>
</li> --}}
