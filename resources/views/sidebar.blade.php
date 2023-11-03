<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link bg-cyan">
    <img src="{{ asset('adminlte/dist/img/spp-2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Spp Sekolah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @if (Auth::guard('petugas')->user())
                <a href="#" class="d-block">{{ Auth::guard('petugas')->user()->nama_petugas }}</a>
            @elseif (Auth::guard('siswa')->user())
            <a href="#" class="d-block">{{ Auth::guard('siswa')->user()->nama_siswa }}</a>
            @endif
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar " type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append ">
            <button class="btn btn-sidebar bg-cyan">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>
            <div class="dropdown-divider"></div>
            @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                <li class="nav-item">
                    <a href="{{ url('datapetugaspage') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                    <p>Petugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('datasiswapage') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                    <p>Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('datakelaspage') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                    <p>Kelas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('datakompetensipage') }}" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                    <p>Kompetensi Keahlian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dataspppage') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Spp</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>
                        Spp
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('dataspppage') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <p class="ml-1">Data Spp</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('registerspppage') }}" class="nav-link">
                            <i class="far fa-dot-circle"></i>
                            <p class="ml-1">Register Spp</p>
                        </a>
                    </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ url('tampilpembayaran') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>Pembayaran Spp</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('histori') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Pembayaran</p>
                    <p style="margin-left: 33px">Spp</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('tampilgenerate') }}" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>
                    <p>Generate Laporan</p>
                    </a>
                </li>
            @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                <li class="nav-item">
                    <a href="{{ url('tampilpembayaranpagepetugas') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>Pembayaran Spp</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('historipetugas') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Pembayaran</p>
                    <p style="margin-left: 33px">Spp</p>
                    </a>
                </li>
            @elseif (Auth::guard('siswa')->check() && Auth::guard('siswa')->user())
                <li class="nav-item">
                    <a href="{{ url('historisiswa') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Pembayaran</p>
                    <p style="margin-left: 33px">Spp</p>
                    </a>
                </li>
            @endif

        <div class="dropdown-divider"></div>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
