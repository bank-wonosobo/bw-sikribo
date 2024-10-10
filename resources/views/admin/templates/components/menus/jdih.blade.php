@can('jenis_jdih.read')
<li class="nav-heading">JDIH</li>
@endcan

@can('jdih.create')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.dokumen-hukum.create') ? '' : 'collapsed' }}" href="{{ route('admin.dokumen-hukum.create') }}">
    <i class='bx bx-detail'></i>
    <span>Tambah Dokumen</span>
    </a>
</li>
@endcan

@can('jdih.read')
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#dokumen-hukum" data-bs-toggle="collapse" href="#">
        <i class='bx bx-food-menu'></i><span>Dokumen Hukum</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dokumen-hukum" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @foreach ( \App\Models\JenisDokumenHukum::all() as $jdh)
        <li>
            <a href="{{ route('admin.dokumen-hukum.index', ['jdh_id' => $jdh->id]) }}">
                <i class="bi bi-circle"></i><span>{{ $jdh->nama }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</li>
@endcan

@can('jenis_jdih.read')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.jenis-dh.*') ? '' : 'collapsed' }}" href="{{ route('admin.jenis-dh.index') }}">
    <i class='bx bx-windows'></i>
    <span>Jenis Dokumen Hukum</span>
    </a>
</li>
@endcan
