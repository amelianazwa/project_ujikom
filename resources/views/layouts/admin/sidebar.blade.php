<style>
    /* Warna background saat hover */
    .menu-item:hover {
        background-color: #ffffff;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }

    /* Warna teks saat hover */
    .menu-item a:hover {
        color: #ccd8e6;
    }

    /* Menandai halaman aktif */
    .menu-item.active {
        background-color: #ffffff !important; /* Warna aktif */
        border-radius: 5px;
    }

    .menu-item.active a {
        color: rgb(100, 100, 100) !important; /* Warna teks aktif */
    }
</style>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/group 7.png') }}" alt="">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dasboard</div>
            </a>
        </li>

        <!-- Master Data -->
        <li class="menu-item {{ request()->is('ruangan*') || request()->is('kategori*') || request()->is('anggota*') || request()->is('barang*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i> <!-- Ikon Master Data -->
                <div>Master Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('ruangan.index') ? 'active' : '' }}">
                    <a href="{{ route('ruangan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-building"></i> <!-- Ikon Ruangan -->
                        <div>Ruangan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-category"></i> <!-- Ikon Kategori -->
                        <div>Kategori</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('anggota.index') ? 'active' : '' }}">
                    <a href="{{ route('anggota.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i> <!-- Ikon Anggota -->
                        <div>Anggota</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
                    <a href="{{ route('barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-box"></i> <!-- Ikon Barang -->
                        <div>Barang</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Peminjaman -->
        <li class="menu-item {{ request()->is('pm_barang*') || request()->is('pm_ruangan*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-archive"></i> <!-- Ikon Peminjaman -->
                <div>Peminjaman</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('pm_barang.index') ? 'active' : '' }}">
                    <a href="{{ route('pm_barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cart"></i> <!-- Ikon Peminjaman Barang -->
                        <div>Peminjaman Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('pm_ruangan.index') ? 'active' : '' }}">
                    <a href="{{ route('pm_ruangan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-building-house"></i> <!-- Ikon Peminjaman Ruangan -->
                        <div>Peminjaman Ruangan</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Pengembalian -->
        <li class="menu-item {{ request()->is('pengembalian*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-refresh"></i> <!-- Ikon Pengembalian -->
                <div>Pengembalian</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('p_barang.index') ? 'active' : '' }}">
                    <a href="{{ route('p_barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cart"></i> <!-- Ikon Peminjaman Barang -->
                        <div>Pengembalian Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('p_ruangan.index') ? 'active' : '' }}">
                    <a href="#" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-door-open"></i> <!-- Ikon Pengembalian Ruangan -->
                        <div>Pengembalian Ruangan</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Maintenance -->
        <li class="menu-item {{ request()->is('m_barang*') || request()->is('m_ruangan*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i> <!-- Ikon Maintenance -->
                <div>Maintenance</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('m_barang.index') ? 'active' : '' }}">
                    <a href="{{ route('m_barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-tool"></i> <!-- Ikon Maintenance Barang -->
                        <div>Maintenance Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('m_ruangan.index') ? 'active' : '' }}">
                    <a href="{{ route('m_ruangan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-buildings"></i> <!-- Ikon Maintenance Ruangan -->
                        <div>Maintenance Ruangan</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Laporan -->
        <li class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book"></i> <!-- Ikon Laporan -->
                <div>Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('l_barang.index') ? 'active' : '' }}">
                    <a href="{{ route('l_barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-file"></i> <!-- Ikon Laporan Peminjaman Barang -->
                        <div>Laporan Peminjaman Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('l_ruangan.index') ? 'active' : '' }}">
                    <a href="{{ route('l_ruangan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-folder"></i> <!-- Ikon Laporan Peminjaman Ruangan -->
                        <div>Laporan Peminjaman Ruangan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('lm_barang.index') ? 'active' : '' }}">
                    <a href="{{ route('lm_barang.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-edit"></i> <!-- Ikon Laporan Maintenance Barang -->
                        <div>Laporan Maintenance Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('lm_ruangan.index') ? 'active' : '' }}">
                    <a href="{{ route('lm_ruangan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i> <!-- Ikon Laporan Maintenance Ruangan -->
                        <div>Laporan Maintenance Ruangan</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
