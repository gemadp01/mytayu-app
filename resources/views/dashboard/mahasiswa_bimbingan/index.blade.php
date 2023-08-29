@extends('dashboard.layouts.main')

@section('page-heading')
    
    <h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Bimbingan Tugas Akhir</h1>
    <h1 class="h3 mb-2 text-gray-800">Tahun Akademik Semester Ganjil - 2022/2023</h1>

    <div class="card shadow mb-4">
        @can('IsDospem')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Dosen Pembimbing 1</h6>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col mb-1">
                    <a href="/dashboard/pengajuan-ta/create" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <span class="text">Buat Agenda Bimbingan</span>
                    </a>
                </div>
            </div> --}}

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
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Nama Pembimbing</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($dospemsatu as $dps)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dps->pengajuanta->npm }}</td>
                            <td>{{ $dps->pengajuanta->nama }}</td>
                            <td>{{ $dps->pengajuanta->program_studi }}</td>
                            <td>{{ $dps->pengajuanta->kelas }}</td>
                            <td>{{ $dps->usulanDospemKaprodiPertama->nama }}</td>
                            <td class="text-center">

                                <a href="/form-bimbingan/{{ $dps->pengajuanta->user_id }}/{{ $dps->usulan_pembimbing_kaprodi1_id }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fa fa-address-book"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $dospemsatu->links() }}
            </div>
        </div>
        @endcan
    </div>

    <div class="card shadow mb-4">
        @can('IsDospem')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Dosen Pembimbing 2</h6>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                <div class="col mb-1">
                    <a href="/dashboard/pengajuan-ta/create" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <span class="text">Buat Agenda Bimbingan</span>
                    </a>
                </div>
            </div> --}}

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
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Nama Pembimbing</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($dospemdua as $dps)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dps->pengajuanta->npm }}</td>
                            <td>{{ $dps->pengajuanta->nama }}</td>
                            <td>{{ $dps->pengajuanta->program_studi }}</td>
                            <td>{{ $dps->pengajuanta->kelas }}</td>
                            <td>{{ $dps->usulanDospemKaprodiKedua->nama }}</td>
                            <td class="text-center">

                                <a href="/form-bimbingan/{{ $dps->pengajuanta->user_id }}/{{ $dps->usulan_pembimbing_kaprodi2_id }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fa fa-address-book"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $dospemdua->links() }}
            </div>
        </div>
        @endcan
    </div>
@endsection