@extends('dashboard.layouts.main')

@section('page-heading')

@can('KaprodiDekan')

<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Seminar Sidang Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Seminar Tugas Akhir</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
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
                        <th>Waktu</th>
                        <th>Ruangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_seminarta as $seminarta)
                    <tr>
                        {{-- @dd($seminarta) --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $seminarta->pengajuansta->npm }}</td>
                        <td>{{ $seminarta->pengajuansta->nama }}</td>
                        <td>{{ $seminarta->pengajuansta->kelas }}</td>
                        <td>{{ $seminarta->pembimbing_1 }}</td>
                        <td>{{ $seminarta->pembimbing_2 }}</td>
                        <td>{{ $seminarta->tanggal_penjadwalan }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Sidang Tugas Akhir</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Penguji Utama</th>
                        <th>Uji 1</th>
                        <th>Uji 2</th>
                        <th>Uji 3</th>
                        <th>Waktu Sidang</th>
                        <th>Ruangan</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($jadwal_sidangta as $sidangta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->pengajuansidangta->kelas }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->penguji_utama_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji1_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji2_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji3_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endcan

@can('IsKoordinator')
    

<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Seminar Sidang Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Seminar Tugas Akhir</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
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
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_seminarta as $seminarta)
                    <tr>
                        {{-- @dd($seminarta) --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $seminarta->pengajuansta->npm }}</td>
                        <td>{{ $seminarta->pengajuansta->nama }}</td>
                        <td>{{ $seminarta->pengajuansta->kelas }}</td>
                        <td>{{ $seminarta->pembimbing_1 }}</td>
                        <td>{{ $seminarta->pembimbing_2 }}</td>
                        <td>{{ $seminarta->tanggal_penjadwalan }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                        <td>
                            <a href="/dashboard/penjadwalan-seminar/{{ $seminarta->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Sidang Tugas Akhir</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Penguji Utama</th>
                        <th>Uji 1</th>
                        <th>Uji 2</th>
                        <th>Uji 3</th>
                        <th>Waktu Sidang</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($jadwal_sidangta as $sidangta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->pengajuansidangta->kelas }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->penguji_utama_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji1_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji2_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $infoDosen->where('id', $sidangta->uji3_id)->pluck('singkatan')->first() }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                        <td>
                            <a href="/dashboard/penjadwalan-sidang/{{ $sidangta->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endcan

@endsection