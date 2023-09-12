
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

    @can('IsDekan')
    <!-- Heading -->
    <div class="sidebar-heading">Data Persetujuan</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item 
    @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/pengajuan-seminarta*') || Request::is('dashboard/usulan-penguji-sidang*'))
        active
    @endif
    ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-check-square" aria-hidden="true"></i>
            <span>Approve data</span>
        </a>
        <div id="collapseTwo" class="collapse 
        @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/pengajuan-seminarta*') || Request::is('dashboard/usulan-penguji-sidang*'))
        show
        @endif
        {{ Request::is('dashboard/pengajuan-ta*') ? 'show' : '' }}
        " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data pengajuan:</h6>
                <a class="collapse-item {{ Request::is('dashboard/pengajuan-ta*') ? 'active' : '' }}" href="/dashboard/pengajuan-ta">Pembimbing TA</a>
                <a class="collapse-item {{ Request::is('dashboard/pengajuan-seminarta*') ? 'active' : '' }}" href="/dashboard/pengajuan-seminarta">Penguji Seminar TA</a>
                <a class="collapse-item {{ Request::is('dashboard/usulan-penguji-sidang*') ? 'active' : '' }}" href="/dashboard/usulan-penguji-sidang">Penguji Sidang TA</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />
    @endcan
        
    @can('MahasiswaKoordinator')
    <!-- Heading -->
    <div class="sidebar-heading">Pendaftaran</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item 
    @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/pengajuan-seminarta*') || Request::is('dashboard/pengajuan-sidangta*') || Request::is('dashboard/detail-pengajuan-ta*'))
        active
    @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Tugas Akhir</span>
        </a>
        <div id="collapseTwo" class="collapse 
        @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/pengajuan-seminarta*') || Request::is('dashboard/pengajuan-sidangta*') || Request::is('dashboard/detail-pengajuan-ta*'))
            show
        @endif" 
        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengajuan:</h6>
                <a class="collapse-item 
                @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/detail-pengajuan-ta*'))
                    active
                @endif" 
                href="/dashboard/pengajuan-ta">Pengajuan Tugas Akhir</a>
                <a class="collapse-item 
                @if(Request::is('dashboard/pengajuan-seminarta*') || Request::is('dashboard/detail-pengajuan-seminarta*'))
                    active
                @endif" 
                href="/dashboard/pengajuan-seminarta">Pengajuan Seminar TA</a>

                <a class="collapse-item 
                @if(Request::is('dashboard/pengajuan-sidangta*') || Request::is('dashboard/detail-pengajuan-sidangta*'))
                    active
                @endif
                " href="/dashboard/pengajuan-sidangta">Pengajuan Sidang TA</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />
    @endcan


    @can('IsMahasiswa')
    <!-- Heading -->
    <div class="sidebar-heading">Bimbingan</div>

    <!-- Nav Item - Bimbingan -->
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/agenda-bimbingan*') ? 'active' : '' }}" href="/dashboard/info-pembimbing">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Bimbingan TA</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Seminar | Sidang</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item 
    @if(Request::is('dashboard/penjadwalan-seminar*') || Request::is('dashboard/penilaian-seminar*'))
        active
    @endif 
    ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Seminar</span>
        </a>
        <div id="collapsePages" class="collapse
        @if(Request::is('dashboard/penjadwalan-seminar*') || Request::is('dashboard/penilaian-seminar*'))
            show
        @endif 
        " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jadwal Hasil:</h6>
                <a class="collapse-item {{ Request::is('dashboard/penjadwalan-seminar*') ? 'active' : '' }}" href="/dashboard/penjadwalan-seminar">Jadwal Seminar TA</a>
                <a class="collapse-item {{ Request::is('dashboard/penilaian-seminar*') ? 'active' : '' }}" href="/dashboard/penilaian-seminar">Hasil Seminar TA</a>
            </div>
        </div>
    </li>

    <li class="nav-item 
    @if(Request::is('dashboard/penjadwalan-sidang*') || Request::is('dashboard/penilaian-sidang*'))
        active
    @endif
    ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSidang"
            aria-expanded="true" aria-controls="collapseSidang">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Sidang</span>
        </a>
        <div id="collapseSidang" class="collapse 
        @if(Request::is('dashboard/penjadwalan-sidang*') || Request::is('dashboard/penilaian-sidang*'))
            show
        @endif 
        " aria-labelledby="headingSidang" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jadwal Hasil:</h6>
                <a class="collapse-item {{ Request::is('dashboard/penjadwalan-sidang*') ? 'active' : '' }}" href="/dashboard/penjadwalan-sidang">Jadwal Sidang TA</a>
                <a class="collapse-item {{ Request::is('dashboard/penilaian-sidang*') ? 'active' : '' }}" href="/dashboard/penilaian-sidang">Hasil Sidang TA</a>
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
    <hr class="sidebar-divider" />
    @endcan

    @can('IsKaprodi')
    <div class="sidebar-heading">Data Pembimbing</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item 
    @if(Request::is('dashboard/pengajuan-ta*') || Request::is('dashboard/detail-pengajuan-ta*'))
        active
    @endif
    ">
        <a class="nav-link active"
        href="/dashboard/pengajuan-ta">
            <i class="fa fa-graduation-cap"></i>
            <span>Pengajuan Pembimbing TA</span>
        </a>
    </li>

    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Input Usulan Penguji</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/usulan-penguji-sidang*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/usulan-penguji-sidang">
            <i class="fa fa-graduation-cap"></i>
            <span>Sidang TA</span>
        </a>
    </li>

    <hr class="sidebar-divider" />
    @endcan

    @can('KoordinatorKaprodiDekan')
    <!-- Heading -->
    <div class="sidebar-heading">Data Mahasiswa TA</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/daftar-mahasiswa-ta*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/daftar-mahasiswa-ta">
        <i class="fa fa-graduation-cap"></i>
        <span>Mahasiswa TA</span></a>
    </li>

    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Data Seminar Sidang</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/daftar-mahasiswa-seminarta*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/daftar-mahasiswa-seminarta">
            <i class="fa fa-graduation-cap"></i>
            <span>Mahasiswa Seminar TA</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('dashboard/daftar-mahasiswa-sidangta*') ? 'active' : '' }}">
        <a class="nav-link"
        href="/dashboard/daftar-mahasiswa-sidangta">
            <i class="fa fa-graduation-cap"></i>
            <span>Mahasiswa Sidang TA</span>
        </a>
    </li>
        
    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Penjadwalan TA</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/penjadwalan-seminar-sidang*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/penjadwalan-seminar-sidang">
            <i class="fa fa-calendar"></i>
            <span>Jadwal Seminar Sidang</span>
        </a>
    </li>

    <hr class="sidebar-divider" />
    @endcan

    @can('IsKoordinator')
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
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />
    @endcan

    @can('IsKaprodi')
    <div class="sidebar-heading">Yudisium</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('yudisium/*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/yudisium">
            <i class="fa fa-graduation-cap"></i>
            <span>Pengumuman Yudisium</span>
        </a>
    </li>

    <hr class="sidebar-divider" />
    @endcan

    @can('IsAdmin')
    <!-- Heading -->
    <div class="sidebar-heading">Data Mahasiswa TA</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/daftar-mahasiswa-ta*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/daftar-mahasiswa-ta">
        <i class="fa fa-graduation-cap"></i>
        <span>Mahasiswa TA</span></a>
    </li>

    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Data SK TA</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/sk-ta*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/sk-ta">
        <i class="fa fa-graduation-cap"></i>
        <span>Info SK TA Mahasiswa</span></a>
    </li>

    <hr class="sidebar-divider" />

    <div class="sidebar-heading">Tahun Akademik</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/tahun-akademik*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/tahun-akademik">
        <i class="fa fa-graduation-cap"></i>
        <span>Tahun Akademik</span></a>
    </li>

    <hr class="sidebar-divider" />
    
    <!-- Heading -->
    <div class="sidebar-heading">Surat Pengantar</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/dosen*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/dosen">
        <i class="fa fa-envelope"></i>
        <span>Surat Pengantar Penelitian</span></a>
    </li>

    <hr class="sidebar-divider" />  
    @endcan

    @can('IsDospem')
    <!-- Heading -->
    <div class="sidebar-heading">Bimbingan</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/mahasiswa-bimbingan*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/mahasiswa-bimbingan">
        <i class="fa fa-check-square"></i>
        <span>Mahasiswa Bimbingan TA</span></a>
    </li>

    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Appointment</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/agenda-bimbingan*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/agenda-bimbingan">
        <i class="fas fa-users"></i>
        <span>Bimbingan</span></a>
    </li>

    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Appointment</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/penjadwalan-seminar') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/penjadwalan-seminar">
        <i class="fa fa-graduation-cap"></i>
        <span>Pengujian Seminar TA</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/penjadwalan-sidang*') ? 'active' : '' }}">
        <a class="nav-link active"
        href="/dashboard/penjadwalan-sidang">
        <i class="fa fa-graduation-cap"></i>
        <span>Pengujian Sidang TA</span></a>
    </li>

    <hr class="sidebar-divider" />
    @endcan
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
