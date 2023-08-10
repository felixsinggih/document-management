<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        @if (auth()->user()->role == 'admin')
            @include('layout.menu-admin')
        @else
            @include('layout.menu-client')
        @endif
    </div>
</aside>
