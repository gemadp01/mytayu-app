@extends('dashboard.layouts.main')

@section('page-heading')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Mahasiswa Tugas Akhir</h1>
    <h1 class="h3 mb-2 text-gray-800">Tahun Akademik Semester Ganjil - 2022/2023</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mahasiswa TA</h6>
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
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @can('IsAdmin')
                                    @if ($pta->status_pengajuan === 4)
                                        <a href="/dashboard/mahasiswa-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuantas->links() }}
            </div>
        </div>
    </div>


@endsection