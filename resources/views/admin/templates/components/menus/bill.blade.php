{{-- @can('manage user') --}}
<li class="nav-heading">Tagihan Manajemen</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.users.*') ? '' : 'collapsed' }}" href="{{ route('admin.users.index') }}">
    <i class='bx bx-user'></i>
    <span>Tagihan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.roles.*') ? '' : 'collapsed' }}" href="{{ route('admin.roles.index') }}">
    <i class='bx bxs-user-detail'></i>
    <span>Customer</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.roles.*') ? '' : 'collapsed' }}" href="{{ route('admin.roles.index') }}">
    <i class='bx bxs-user-detail'></i>
    <span>Send Tagihan</span>
    </a>
</li>

{{-- @endcan --}}
