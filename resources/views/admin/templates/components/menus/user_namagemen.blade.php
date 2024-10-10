@can('user.read')
<li class="nav-heading">User Management</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.users.*') ? '' : 'collapsed' }}" href="{{ route('admin.users.index') }}">
    <i class='bx bx-user'></i>
    <span>User</span>
    </a>
</li>
@endcan

@can('role.read')
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.roles.*') ? '' : 'collapsed' }}" href="{{ route('admin.roles.index') }}">
    <i class='bx bxs-user-detail'></i>
    <span>Roles</span>
    </a>
</li>
@endcan
