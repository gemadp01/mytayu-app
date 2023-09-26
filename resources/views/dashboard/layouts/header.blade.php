
{{-- @dd(auth()->user()->pengajuantugasakhir[0]->suratketeranganta) --}}
@can('IsMahasiswa')
    @php
    $saatIni = Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
    $dateNow = Carbon\Carbon::createFromFormat('Y-m-d', $saatIni);

    $tanggalBerakhirSk = App\Models\PengajuanTugasAkhir::with(['user', 'usulanDospemPertama', 'usulanDospemKedua'])->where('user_id', auth()->user()->id)->get();
    // dd($tanggalBerakhirSk);
    if ($tanggalBerakhirSk->count() > 0) {
        if ($tanggalBerakhirSk[0]->suratketeranganta->tanggal_berakhir !== null) {
            $dateSk = Carbon\Carbon::createFromFormat('Y-m-d', $tanggalBerakhirSk[0]->suratketeranganta->tanggal_berakhir);
        }else {
            $dateSk = "Belum ada SK TA";
        }
    }else {
        $dateSk = "Belum ada SK TA";
    }
    @endphp
@endcan

{{-- @dd($pengajuanTa) --}}

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        @can('KoordinatorKaprodiDekan')
        
            @if (auth()->user()->level_user === 'koordinator')
                @php
                    $pengajuanTa = App\Models\PengajuanTugasAkhir::where('status_pengajuan', 1)->count();
                    $pengajuanSeminarTa = App\Models\PengajuanSeminarTugasAkhir::where('status_pengajuan_seminar', 1)->count();
                    $pengajuanSidangTa = App\Models\PengajuanSidangTugasAkhir::where('status_pengajuan_sidang', 1)->count();
                @endphp
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Pengajuan TA <span class="badge text-bg-secondary">
                                {{ $pengajuanTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Seminar TA <span class="badge text-bg-secondary">
                                {{ $pengajuanSeminarTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Sidang TA <span class="badge text-bg-secondary">
                                {{ $pengajuanSidangTa }}
                            </span>
                        </button>
                    </a>
                </li>

            @elseif (auth()->user()->level_user === 'kaprodi')
            @php
                $pengajuanTa = App\Models\PengajuanTugasAkhir::where('status_pengajuan', 2)->count();
                $pengajuanUlangTa = App\Models\PengajuanTugasAkhir::where('status_pengajuan', 5)->count();
                // $pengajuanSeminarTa = App\Models\PengajuanSeminarTugasAkhir::where('status_pengajuan_seminar', 1)->count();
                $pengajuanSidangTa = App\Models\PengajuanSidangTugasAkhir::where('status_pengajuan_sidang', 2)->count();
            @endphp
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Pengajuan TA <span class="badge text-bg-secondary">
                                {{ $pengajuanTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Sidang TA <span class="badge text-bg-secondary">
                                {{ $pengajuanSidangTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                           Pengajuan Ulang <span class="badge text-bg-secondary">
                                {{ $pengajuanUlangTa }}
                            </span>
                        </button>
                    </a>
                </li>

            @elseif (auth()->user()->level_user === 'dekan')
                @php
                    $pengajuanTa = App\Models\PengajuanTugasAkhir::where('status_pengajuan', 3)->count();
                    $pengajuanSeminarTa = App\Models\PengajuanSeminarTugasAkhir::where('status_pengajuan_seminar', 3)->count();
                    $pengajuanSidangTa = App\Models\PengajuanSidangTugasAkhir::where('status_pengajuan_sidang', 3)->count();
                @endphp
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Pengajuan TA <span class="badge text-bg-secondary">
                                {{ $pengajuanTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Seminar TA <span class="badge text-bg-secondary">
                                {{ $pengajuanSeminarTa }}
                            </span>
                        </button>
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-primary">
                            Sidang TA <span class="badge text-bg-secondary">
                                {{ $pengajuanSidangTa }}
                            </span>
                        </button>
                    </a>
                </li>

            @endif

        @endcan

        @can('IsAdmin')

            @php
                $pengajuanTa = App\Models\PengajuanTugasAkhir::where('status_pengajuan', 4)->count();
            @endphp
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-primary">
                        Pengajuan TA <span class="badge text-bg-secondary">
                            {{ $pengajuanTa }}
                        </span>
                    </button>
                </a>
            </li>
        @endcan

        @can('IsMahasiswa')
            <!-- Nav Item - infoSK -->
            
            @if ($tanggalBerakhirSk->count() > 0 && $tanggalBerakhirSk[0]->status_pengajuan === 4 && $tanggalBerakhirSk[0]->suratketeranganta->tanggal_berakhir !== null)
                @if ($dateNow->year >= $dateSk->year && $dateNow->month >= $dateSk->month && $dateNow->day >= $dateSk->day)
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge text-bg-danger">Mohon daftar ulang TA !</span> 
                        </a>
                    </li>
                @else
                {{-- <span class="badge text-bg-success">diterima...</span> --}}
                @endif    
            @endif

        @endcan

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                </span>
                <img class="img-profile rounded-circle" src="/img/undraw_profile.svg" />
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/dashboard/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>

            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
