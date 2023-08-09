<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="/img/unibi.png" alt="" width="25px">
        </div>
        <div class="sidebar-brand-text mx-3">FTI UNIBI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Pendaftaran</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Tugas Akhir</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengajuan:</h6>
                <a class="collapse-item" href="">Pengajuan Tugas Akhir</a>
                <a class="collapse-item" href="">Pengajuan Seminar TA</a>
                <a class="collapse-item" href="">Pengajuan Sidang TA</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Bimbingan</div>

    <!-- Nav Item - Bimbingan -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Bimbingan TA</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Seminar | Sidang</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Seminar</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jadwal Hasil:</h6>
                <a class="collapse-item" href="login.html">Jadwal Seminar TA</a>
                <a class="collapse-item" href="register.html">Hasil Seminar TA</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSidang"
            aria-expanded="true" aria-controls="collapseSidang">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Sidang</span>
        </a>
        <div id="collapseSidang" class="collapse" aria-labelledby="headingSidang" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jadwal Hasil:</h6>
                <a class="collapse-item" href="login.html">Jadwal Sidang TA</a>
                <a class="collapse-item" href="register.html">Hasil Sidang TA</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Surat Pengantar</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSurat"
            aria-expanded="true" aria-controls="collapseSurat">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Surat Pengantar TA</span>
        </a>
        <div id="collapseSurat" class="collapse" aria-labelledby="headingSurat" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Info Surat Pengantar:</h6>
                <a class="collapse-item" href="login.html">Pengantar Penelitian</a>
                <a class="collapse-item" href="register.html">Info SK Pengantar</a>
            </div>
        </div>
    </li>

    @can('IsKoordinator')
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Data User</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('dashboard/dosen*') ? 'active' : '' }}">
            <a class="nav-link active"
                href="/dashboard/dosen">
                <i class="fas fa-users"></i>
                <span>Daftar Dosen FTI</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('dashboard/mahasiswa*') ? 'active' : '' }}">
            <a class="nav-link"
                href="/dashboard/mahasiswa">
                <i class="fas fa-users"></i>
                <span>Daftar Mahasiswa</span></a>
        </li>
    @endcan



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
