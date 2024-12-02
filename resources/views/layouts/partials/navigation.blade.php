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
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-title">Master Data</li>
        <li class="sidebar-item {{ request()->is('suppliers*') ? 'active' : '' }}">
            <a href="{{ route('suppliers.index') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Suppliers</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('products*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('customers*') ? 'active' : '' }}">
            <a href="{{ route('customers.index') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Customer</span>
            </a>
        </li>

        <li class="sidebar-title">Transaksi</li>
        <li class="sidebar-item {{ request()->is('pemesanans*') ? 'active' : '' }}">
            <a href="{{ route('pemesanans.index') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Pemesanan</span>
            </a>
        </li>


        @auth
            <li class="sidebar-title">User Management</li>
            <li class="sidebar-item {{ request()->routeIs('administrators.*') ? 'active' : '' }}">
                <a href="{{ route('administrators.index') }}" class='sidebar-link'>
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Administrator</span>
                </a>
            </li>

            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}" id="logout">
                    @csrf

                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        @endauth

    </ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
