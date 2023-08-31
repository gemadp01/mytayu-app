@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsMahasiswa')

<h1 class="h3 mb-2 text-gray-800">Jadwal Sidang Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Sidang Tugas Akhir</h6>
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
                    @if ($jadwal_sidangta !== null)
                    <tr>
                        <td>1</td>
                        <td>{{ $jadwal_sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $jadwal_sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $jadwal_sidangta->pengajuansidangta->kelas }}</td>
                        <td>{{ $dospem1->nama }}</td>
                        <td>{{ $dospem2->nama }}</td>
                        <td>{{ $jadwal_sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $jadwal_sidangta->ruangan }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcan

@can('IsDospem')

<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Sidang Tugas Akhir</h1>
<h1 class="h3 mb-2 text-gray-800">Tahun Akademik Semester Ganjil - 2022/2023</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Penguji Utama</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Waktu Sidang</th>
                        <th>Ruangan</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_sidangta1 as $sidangta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
                            </div>
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
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Penguji 1</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_sidangta2 as $sidangta)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
                            </div>
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
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Penguji 2</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_sidangta3 as $sidangta)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
                            </div>
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
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Penguji 3</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_sidangta4 as $sidangta)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sidangta->pengajuansidangta->npm }}</td>
                        <td>{{ $sidangta->pengajuansidangta->nama }}</td>
                        <td>{{ $sidangta->tanggal_penjadwalan }}</td>
                        <td>{{ $sidangta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-sidang/{{ $sidangta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
                            </div>
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