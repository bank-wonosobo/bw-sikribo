<li class="nav-heading">Arsip Kredit</li>

<li class="nav-item">
    <a href="{{ route('admin.kredit.index') }}" class="nav-link {{ Route::is('admin.kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-file-find'></i>
        <span>Arsip Perjanjian Kredit</span>
    </a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
    <a href="{{ route('admin.kategori-kredit.index') }}" class="nav-link {{ Route::is('admin.kategori-kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-credit-card-front'></i>
        <span>Jenis Kredit</span>
    </a>
</li>
