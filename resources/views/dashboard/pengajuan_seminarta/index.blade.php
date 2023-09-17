@extends('dashboard.layouts.main')

@section('page-heading')
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Seminar Tugas Akhir Mahasiswa</h1>
    <h1 class="h3 mb-2 text-gray-800">
        Tahun Akademik Semester {{ $tahunAkademik->semester }} - {{ $tahunAkademik->tahun_akademik }}
    </h1>

    <div class="card shadow mb-4">

        @can('IsMahasiswa')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Seminar Tugas Akhir</h6>
        </div>


        <div class="card-body">
            @if (auth()->user()->pengajuanseminarta->count() < 1)
                @if (!auth()->user()->pengajuantugasakhir->count())
                <div class="alert alert-danger" role="alert">
                    Lakukan Pendaftaran Tugas Akhir Terlebih Dahulu!
                </div>
                @elseif (auth()->user()->pengajuantugasakhir->count() > 0)
                <div class="row">
                    <div class="col mb-1">
                        @if (isset($approved_seminar[$userid_seminar]) && $approved_seminar[$userid_seminar] >= $min_bimbingan)
                        <a href="/dashboard/pengajuan-seminarta/create" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </span>
                            <span class="text">Pengajuan Seminar Tugas Akhir</span>
                        </a>
                        @else
                        <div class="alert alert-danger" role="alert">
                            Lakukan bimbingan dengan dosen pembimbing terlebih dahulu!
                        </div>
                        @endif
                        
                    </div>
                </div>
                @endif
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
                        {{-- @dd($pengajuanseminarta[0]->sertifikat_kegiatan) --}}
                        
                        @foreach($pengajuanseminarta as $pta)
                        <tr>
                            {{-- @foreach(json_decode($pta->sertifikat_kegiatan) as $sertifikat)
                            <img src="{{ asset('storage/' . $sertifikat) }}" class="card-img-top" alt="...">
                            @endforeach --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->no_pengajuan_seminar }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->tanggal_pengajuan }}</td>
                            <td>
                                @if ($pta->status_pengajuan_seminar === 0)
                                    <span class="badge text-bg-danger">direvisi...</span>
                                @elseif ($pta->status_pengajuan_seminar === 1)
                                    <span class="badge text-bg-warning">diproses...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($pta->status_pengajuan_seminar === 1 || $pta->status_pengajuan_seminar === 2 || $pta->status_pengajuan_seminar === 3 || $pta->status_pengajuan_seminar === 4)
                                    <a href="/dashboard/pengajuan-seminarta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="/dashboard/pengajuan-seminarta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-seminarta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

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
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Seminar Tugas Akhir</h6>
        </div>

        <div class="card-body">
            <div class="row py-1">
                <div class="col-12 col-md-6">
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
                        <span class="text">Import data pengajuan seminar ta</span>
                    </button>
                    </form>
                </div>
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
                        
                        @foreach($pengajuanseminartas as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->no_pengajuan_seminar }}</td>
                            <td>{{ $pta->tanggal_pengajuan }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>{{ $pta->kelas }}</td>
                            <td>{{ $pta->email }}</td>
                            <td>
                                @if ($pta->status_pengajuan_seminar === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($pta->status_pengajuan_seminar === 1)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($pta->status_pengajuan_seminar === 1)
                                    <a href="/dashboard/detail-pengajuan-seminarta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                @else
                                    <a href="/dashboard/detail-pengajuan-seminarta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-seminarta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuanseminartas->links() }}
            </div>
        </div>
        @endcan

        @can('IsDekan')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Seminar Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row py-1">
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
                            <th>No Pengajuan Seminar</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuanseminartas as $pta)
                        @if ($pta->status_pengajuan_seminar === 3)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->no_pengajuan_seminar }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>
                                @if ($pta->status_pengajuan_seminar === 3)
                                    <span class="badge text-bg-danger">belum disetujui...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                
                                <button type="button" class="btn btn-success btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-check"></i>
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Approve Pengajuan Seminar Mahasiswa</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <form method="post" action="/dashboard/detail-pengajuan-seminarta/{{ $pta->id }}">
                                                @method('put')
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                                                    <input type="email" class="form-control" name="nama" id="nama" value="{{ $pta->nama }}" readonly>
                                                </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Approve</button>
                                        </div>
                                            </form>
                                      </div>
                                    </div>
                                </div>

                                <a href="/dashboard/pengajuan-seminarta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuanseminartas->links() }}
            </div>
        </div>
        @endcan

    </div>
@endsection