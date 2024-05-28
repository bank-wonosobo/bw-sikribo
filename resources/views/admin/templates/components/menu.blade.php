<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ Route::is('admin.dashboard.*') ? '' : 'collapsed' }}" href="index.html">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @include('admin.templates.components.menus.arsip_kredit')

    @include('admin.templates.components.menus.slik')

    @include('admin.templates.components.menus.jdih')

    @include('admin.templates.components.menus.user_namagemen')

    @include('admin.templates.components.menus.other')


</ul>
