<div class="sidebar-header">
    <div class="d-flex justify-content-between">
        <div class="logo">
            <a
                href="@if (!Auth::guest()) {{ route('dashboard') }} @else {{ route('dashboard.guest') }} @endif">{{ config('app.name') }}</a>
        </div>
        <div class="toggler">
            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
    </div>
</div>
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-title mt-4">Master Data</li>
        <li class="sidebar-item {{ request()->is('suppliers*') ? 'active' : '' }}">
            <a href="{{ route('suppliers.index') }}" class='sidebar-link'>
                <i class="bi bi-person-check-fill"></i>
                <span>Suplier</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('products*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}" class='sidebar-link'>
                <i class="bi bi-box"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="sidebar-title mt-4">Transaksi</li>
        <li class="sidebar-item {{ request()->is('penjualans*') ? 'active' : '' }}">
            <a href="{{ route('penjualans.index') }}" class='sidebar-link'>
                <i class="bi bi-cash-stack"></i>
                <span>Penjualan</span>
            </a>
        </li>

        @auth
            <li class="sidebar-title mt-4">User Management</li>
            <li class="sidebar-item {{ request()->routeIs('administrators.*') ? 'active' : '' }}">
                <a href="{{ route('administrators.index') }}" class='sidebar-link'>
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Administrator</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('customers*') ? 'active' : '' }}">
                <a href="{{ route('customers.index') }}" class='sidebar-link'>
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Customer</span>
                </a>
            </li>

            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}" id="logout">
                    @csrf

                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        @endauth

    </ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
