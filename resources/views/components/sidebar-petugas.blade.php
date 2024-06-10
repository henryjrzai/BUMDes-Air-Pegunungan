<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/petugas') }}" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/petugas') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER DATA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('record-water-usages') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-book"></i>
                        </span>
                        <span class="hide-menu">Catat Penggunaan Air</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('getCustomers') }}" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="hide-menu">Pelanggan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index.html" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-table"></i>
                        </span>
                        <span class="hide-menu">Riwayat Penggunaan</span>
                    </a>    
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="index.html" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-book-open"></i>
                        </span>
                        <span class="hide-menu">Buat Laporan</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
