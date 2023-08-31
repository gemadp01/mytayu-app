@extends('dashboard.layouts.main')

@section('page-heading')
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Usulan Penguji</h6>
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
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Status Input Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($data_sidangta as $psd)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $psd->pengajuansidangta->npm }}</td>
                            <td>{{ $psd->pengajuansidangta->nama }}</td>
                            <td>{{ $psd->pengajuansidangta->kelas }}</td>
                            <td>{{ $infoDosen->where('id', $psd->pembimbing1_id)->pluck('singkatan')->first() }}</td>
                            <td>{{ $infoDosen->where('id', $psd->pembimbing2_id)->pluck('singkatan')->first() }}</td>
                            <td>{{ $infoDosen->where('id', $psd->penguji1_id)->pluck('singkatan')->first() }}</td>
                            <td>{{ $infoDosen->where('id', $psd->penguji2_id)->pluck('singkatan')->first() }}</td>
                            <td>
                                @if ($psd->pengajuansidangta->status_pengajuan_sidang === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($psd->pengajuansidangta->status_pengajuan_sidang === 1 || $psd->pengajuansidangta->status_pengajuan_sidang === 2)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($psd->pengajuansidangta->status_pengajuan_sidang === 0 || $psd->pengajuansidangta->status_pengajuan_sidang === 1 || $psd->pengajuansidangta->status_pengajuan_sidang === 3)
                                    <a href="/yudisium/{{ $psd->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="/yudisium/{{ $psd->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $data_sidangta->links() }}
            </div>
        </div>
    </div>

@endsection