@canany(['arsip_kredit.read', 'pemberkasan_kredit.read', 'pra_komite_kredit.read', 'komite_kredit.read', 'assesment_kredit.read'])
<li class="nav-heading">Arsip Kredit</li>
@endcanany

@can('pemberkasan_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.pemberkasan-kredit.index') }}" class="nav-link {{ Route::is('admin.pemberkasan-kredit.*') ? '' : 'collapsed' }}">
        <i class='bx bx-folder'></i>
        <span>Arsip Pemberkasan Kredit</span>
    </a>
</li>
@endcan

@can('pra_komite_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.pra-komite-kredit.index') }}" class="nav-link {{ Route::is('admin.pra-komite-kredit.*') ? '' : 'collapsed' }}">
        <i class='bx bx-news'></i>
        <span>Arsip Pra Komite Kredit</span>
    </a>
</li>
@endcan

@can('assesment_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.assesment-kredit.index') }}" class="nav-link {{ Route::is('admin.assesment-kredit.*') ? '' : 'collapsed' }}">
        <i class='bx bx-spreadsheet'></i>
        <span>Arsip Assesment Kredit</span>
    </a>
</li>
@endcan

@can('komite_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.komite-kredit.index') }}" class="nav-link {{ Route::is('admin.komite-kredit.*') ? '' : 'collapsed' }}">
        <i class='bx bx-news'></i>
        <span>Arsip Komite Kredit</span>
    </a>
</li>
@endcan

@can('arsip_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.kredit.index') }}" class="nav-link {{ Route::is('admin.kredit.*') ? '' : 'collapsed' }}">
        <i class='bx bx-archive'></i>
        <span>Arsip Perjanjian Kredit</span>
    </a>
</li>
@endcan

@can('kategori_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.kategori-kredit.index') }}" class="nav-link {{ Route::is('admin.kategori-kredit.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-archive-in' ></i>
        <span>Jenis Kredit</span>
    </a>
</li>
@endcan

@can('jenis_kredit.read')
<li class="nav-item">
    <a href="{{ route('admin.jenis-jaminan.index') }}" class="nav-link {{ Route::is('admin.jenis-jaminan.*') ? '' : 'collapsed' }}" href="users-profile.html">
        <i class='bx bx-archive-in' ></i>
        <span>Jenis Jaminan</span>
    </a>
</li>
@endcan

