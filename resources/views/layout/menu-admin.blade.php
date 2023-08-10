<ul class="menu-inner">

    {{-- Admin Dashboard --}}
    <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a href="/admin/dashboard" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i> Dashboard
        </a>
    </li>

    <!-- Admin -->
    <li class="menu-item {{ Request::is('admin/admin*') ? 'active' : '' }}">
        <a href="/admin/admin" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i> Admin
        </a>
    </li>

    {{-- Perusahaan --}}
    <li class="menu-item {{ Request::is('admin/company*') ? 'active' : '' }}">
        <a href="/admin/company" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i> Perusahaan
        </a>
    </li>
    {{-- <li class="menu-item {{ Request::is('admin/company*') ? 'active' : '' }}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-building-community"></i> Perusahaan
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('admin/company') ? 'active' : '' }}">
                <a href="/admin/company" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-building-community"></i> Perusahaan
                </a>
            </li>
        </ul>
    </li> --}}

    {{-- Perusahaan --}}
    <li class="menu-item {{ Request::is('admin/document*') ? 'active' : '' }}">
        <a href="/admin/document" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i> Dokumen
        </a>
    </li>

</ul>
