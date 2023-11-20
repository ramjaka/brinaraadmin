<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">BRN</a>
    </div>
    <ul class="sidebar-menu">
        <li {{ is_nav_active('dashboard') }}>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        @canany(['isAdmin', 'isOwner'])
        <li class="menu-header">MASTER</li>
        <li {{ is_nav_active('categories') }}>
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="fas fa-box"></i> <span>Kategori</span>
            </a>
        </li>
        <li {{ is_nav_active('products') }}>
            <a class="nav-link" href="{{ route('admin.product.index') }}">
                <i class="fas fa-boxes"></i> <span>Produk</span>
            </a>
        </li>
        <li {{ is_nav_active('members') }}>
            <a class="nav-link" href="{{ route('admin.member.index') }}">
                <i class="fas fa-id-card"></i> <span>Member</span>
            </a>
        </li>
        <li {{ is_nav_active('suppliers') }}>
            <a class="nav-link" href="{{ route('admin.supplier.index') }}">
                <i class="fas fa-truck"></i> <span>Supplier</span>
            </a>
        </li>
        @endcanany

        <li class="menu-header">TRANSAKSI</li>
        @canany(['isAdmin', 'isOwner'])
        <li {{ is_nav_active('pengeluaran') }}>
            <a class="nav-link" href="{{ route('admin.pengeluaran.index') }}">
                <i class="fas fa-wallet"></i> <span>Pengeluaran</span>
            </a>
        </li>
        @endcanany
        <li class="dropdown {{ is_drop_active('barang') }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-box-open"></i> <span>Barang</span>
            </a>
            <ul class="dropdown-menu">
                @canany(['isAdmin', 'isOwner'])
                <li {{ is_nav_active('barang/pembelian') }}>
                    <a class="nav-link" href="{{ route('admin.pembelian.index') }}">
                        Pembelian Barang
                    </a>
                </li>
                @endcanany
                <li {{ is_nav_active('barang/penjualan') }}>
                    <a class="nav-link" href="{{ route('admin.penjualan.index') }}">
                        Penjualan Barang
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown {{ is_drop_active('transaksi') }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-money-bill-wave-alt"></i> <span>Transaksi</span>
            </a>
            <ul class="dropdown-menu">
                <li {{ is_nav_active('transaksi/penjualan/baru') }}>
                    <a class="nav-link" href="{{ route('admin.transaksi.penjualan.index') }}">
                        Transaksi Baru
                    </a>
                </li>
                <li {{ is_nav_active('transaksi/penjualan/aktif') }}>
                    <a class="nav-link" href="{{ route('admin.transaksi.penjualan.index') }}">
                        Transaksi Aktif
                    </a>
                </li>
            </ul>
        </li>
        @canany(['isAdmin', 'isOwner'])
        <li class="menu-header">REPORT</li>
        <li {{ is_nav_active('laporan') }}>
            <a class="nav-link" href="{{ route('admin.laporan.index') }}">
                <i class="fas fa-file"></i> <span>Laporan</span>
            </a>
        </li>
        @endcanany

        <li class="menu-header">SYSTEM</li>
        @can('isOwner')
        <li {{ is_nav_active('users') }}>
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fas fa-users"></i> <span>Pengguna</span>
            </a>
        </li>
        <li {{ is_nav_active('settings') }}>
            <a class="nav-link" href="{{ route('admin.setting.index') }}">
                <i class="fas fa-cog"></i> <span>Pengaturan</span>
            </a>
        </li>
        @endcan
        <li {{ is_nav_active('cleaners') }}>
            <a class="nav-link" href="{{ route('admin.cleaner.index') }}">
                <i class="fas fa-trash-alt"></i> <span>Cleaner</span>
            </a>
        </li>
    </ul>
</aside>