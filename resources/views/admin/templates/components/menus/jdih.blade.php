<li class="nav-heading">JDIH</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
    <i class="bi bi-question-circle"></i>
    <span>Tambah Dokumen</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#dokumen-hukum" data-bs-toggle="collapse" href="#">
        <i class="bx bxs-cog"></i><span>Dokumen Hukum</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dokumen-hukum" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @foreach ( \App\Models\JenisDokumenHukum::all() as $jdh)
        <li>
            <a href="#">
                <i class="bi bi-circle"></i><span>{{ $jdh->nama }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.faq') ? '' : 'collapsed' }}" href="{{ route('admin.faq') }}">
    <i class="bi bi-question-circle"></i>
    <span>Jenis Dokumen Hukum</span>
    </a>
</li>
