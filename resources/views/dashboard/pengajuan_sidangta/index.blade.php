@extends('dashboard.layouts.main')

@section('page-heading')
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Sidang Tugas Akhir Mahasiswa</h1>
    <h1 class="h3 mb-2 text-gray-800">
        Tahun Akademik Semester {{ $tahunAkademik->semester }} - {{ $tahunAkademik->tahun_akademik }}
    </h1>

    <div class="card shadow mb-4">

        @can('IsMahasiswa')

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Seminar Tugas Akhir</h6>
        </div>


        <div class="card-body">
            @if($pengajuanseminartas > 0)
            <a href="/dashboard/pengajuan-sidangta/create" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Pengajuan Sidang Tugas Akhir</span>
            </a>
            @else
            <div class="alert alert-danger" role="alert">
                Mohon lakukan Seminar Tugas Akhir Terlebih Dahulu!
            </div>
            @endif

            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Pengajuan</th>
                            <th>Nomor Pokok Mahasiswa</th>
                            <th>Nama</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuansidangta as $psta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $psta->no_pengajuan_sidang }}</td>
                            <td>{{ $psta->npm }}</td>
                            <td>{{ $psta->nama }}</td>
                            <td>{{ $psta->tanggal_pengajuan }}</td>
                            <td>
                                {{-- @if ($psta->status_pengajuan_sidang === 0)
                                    <span class="badge text-bg-danger">direvisi...</span>
                                @elseif ($psta->status_pengajuan_sidang === 1)
                                    <span class="badge text-bg-warning">diproses...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif --}}
                                @if ($psta->status_pengajuan_sidang === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($psta->status_pengajuan_sidang === 1)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 2)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 4)
                                    <span class="badge text-bg-success">Pengajuan Diterima...</span>
                                @elseif ($psta->status_pengajuan_sidang === 5)
                                    <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($psta->status_pengajuan_sidang === 1 || $psta->status_pengajuan_sidang === 2 || $psta->status_pengajuan_sidang === 3 || $psta->status_pengajuan_sidang === 4)
                                    <a href="/dashboard/pengajuan-sidangta/{{ $psta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="/dashboard/pengajuan-sidangta/{{ $psta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-sidangta/{{ $psta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @if ($psta->yudisium)
                                <a href="{{ asset('storage/' . $psta->yudisium) }}" class="btn btn-primary btn-circle btn-sm" download>
                                    <i class="fa fa-download"></i>
                                </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endcan

        @can('IsKoordinator')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Sidang Tugas Akhir</h6>
        </div>

        <div class="card-body">
            <div class="row py-1">
                {{-- <div class="col-12 col-md-6">
                    <form action="/pengajuan-ta/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            @error('excel_file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="file" name="excel_file" class="form-control">
                            <small class="text-body-secondary">.xlsx(excel)</small>
                        </div>
                    </div>
                <div class="col-12 col-md-6 mt-1">
                    <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </span>
                        <span class="text">Import data pengajuan sidang ta</span>
                    </button>
                    </form>
                </div> --}}
                <div class="col-12 col-md-6">
                    <a href="/pengajuan-ta/export-to-pdf" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to PDF</span>
                    </a>
                    <a href="/pengajuan-ta/export-to-excel" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to Excel</span>
                    </a>
                </div>   
            </div>
            
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Pengajuan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nomor Pokok Mahasiswa</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($pengajuansidangtas as $psta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $psta->no_pengajuan_sidang }}</td>
                            <td>{{ $psta->tanggal_pengajuan }}</td>
                            <td>{{ $psta->npm }}</td>
                            <td>{{ $psta->nama }}</td>
                            <td>{{ $psta->program_studi }}</td>
                            <td>{{ $psta->kelas }}</td>
                            <td>{{ $psta->email }}</td>
                            <td>
                                {{-- @if ($psta->status_pengajuan_sidang === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($psta->status_pengajuan_sidang === 1)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif --}}
                                @if ($psta->status_pengajuan_sidang === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($psta->status_pengajuan_sidang === 1)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 2)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($psta->status_pengajuan_sidang === 4)
                                    <span class="badge text-bg-success">Pengajuan Diterima...</span>
                                @elseif ($psta->status_pengajuan_sidang === 5)
                                    <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($psta->status_pengajuan_sidang === 0 || $psta->status_pengajuan_sidang === 2 || $psta->status_pengajuan_sidang === 3 || $psta->status_pengajuan_sidang === 4)
                                    <a href="/dashboard/detail-pengajuan-sidangta/{{ $psta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="/dashboard/detail-pengajuan-sidangta/{{ $psta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-sidangta/{{ $psta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuansidangtas->links() }}
            </div>
        </div>
        @endcan

    </div>
@endsection