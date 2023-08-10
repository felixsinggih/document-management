<ul class="menu-inner">

    {{-- Client Dashboard --}}
    <li class="menu-item {{ Request::is('client/dashboard') ? 'active' : '' }}">
        <a href="/client/dashboard" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i> Dashboard
        </a>
    </li>

    {{-- Document --}}
    <li class="menu-item {{ Request::is('client/document*') ? 'active' : '' }}">
        <a href="/client/document" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i> Dokumen
        </a>
    </li>

</ul>
