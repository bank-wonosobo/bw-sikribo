@can('manage arsip kredit')
<li class="nav-heading">Arsip Kredit</li>

<li class="nav-item">
    <a href="{{ route('admin.kredit.index') }}" class="nav-link {{ Route::is('admin.kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-archive' ></i>
        <span>Arsip Perjanjian Kredit</span>
    </a>
</li><!-- End Profile Page Nav -->

<li class="nav-item">
    <a href="{{ route('admin.kategori-kredit.index') }}" class="nav-link {{ Route::is('admin.kategori-kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-archive-in' ></i>
        <span>Jenis Kredit</span>
    </a>
</li>

@endcan
