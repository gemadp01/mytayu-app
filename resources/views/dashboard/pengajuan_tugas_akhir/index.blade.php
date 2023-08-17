@extends('dashboard.layouts.main')

@section('page-heading')
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Mahasiswa Tugas Akhir</h1>
    <h1 class="h3 mb-2 text-gray-800">Tahun Akademik Semester Ganjil - 2022/2023</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Skripsi/Tugas Akhir</h6>
        </div>
        <div class="card-body">
            @can('IsMahasiswa')
                <div class="row">
                    <div class="col mb-1">
                        <a href="/dashboard/pengajuan-ta/create" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </span>
                            <span class="text">Pengajuan Tugas Akhir</span>
                        </a>
                    </div>
                </div>
            @endcan

            @can('IsKoordinator')
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
                            <span class="text">Import data pengajuan ta</span>
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
                            
                            @foreach($pengajuantas as $pta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pta->nomor_pengajuan }}</td>
                                <td>{{ $pta->tanggal_pengajuan }}</td>
                                <td>{{ $pta->npm }}</td>
                                <td>{{ $pta->nama }}</td>
                                <td>{{ $pta->program_studi }}</td>
                                <td>{{ $pta->kelas }}</td>
                                <td>{{ $pta->email }}</td>
                                <td>
                                    @if ($pta->status_pengajuan === 0)
                                        <span class="badge text-bg-danger">revisi...</span>
                                    @elseif ($pta->status_pengajuan === 1)
                                        <span class="badge text-bg-warning">belum diperiksa...</span>
                                    @elseif ($pta->status_pengajuan === 2)
                                        <span class="badge text-bg-success">diterima...</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($pta->status_pengajuan === 0 && ($pta->status_pengajuan === 2))
                                        <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm" disabled>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    {{-- tombol delete --}}
                                    <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $pengajuantas->links() }}
                </div>
            @endcan
            
            @can('IsMahasiswa')
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
                            
                            @foreach($pengajuanta as $pta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pta->nomor_pengajuan }}</td>
                                <td>{{ $pta->npm }}</td>
                                <td>{{ $pta->nama }}</td>
                                <td>{{ $pta->tanggal_pengajuan }}</td>
                                <td>
                                    @if ($pta->status_pengajuan === 0)
                                        <span class="badge text-bg-danger">direvisi...</span>
                                    @elseif ($pta->status_pengajuan === 1)
                                        <span class="badge text-bg-warning">diproses...</span>
                                    @elseif ($pta->status_pengajuan === 2)
                                        <span class="badge text-bg-success">diterima...</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($pta->status_pengajuan === 1 && $pta->status_pengajuan === 2)
                                        <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    {{-- <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endcan
            
            
        </div>
        
    </div>

@endsection