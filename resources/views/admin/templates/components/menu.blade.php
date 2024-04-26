<!-- Nav Item - Dashboard -->
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
@endcan

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
