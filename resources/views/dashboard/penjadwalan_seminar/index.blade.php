@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsMahasiswa')

<h1 class="h3 mb-2 text-gray-800">Jadwal Seminar Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Seminar Tugas Akhir</h6>
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
                    @if ($jadwal_seminarta !== null)
                    <tr>
                        <td>1</td>
                        <td>{{ $jadwal_seminarta->pengajuansta->npm }}</td>
                        <td>{{ $jadwal_seminarta->pengajuansta->nama }}</td>
                        <td>{{ $jadwal_seminarta->pengajuansta->kelas }}</td>
                        <td>{{ $jadwal_seminarta->pembimbing_1 }}</td>
                        <td>{{ $jadwal_seminarta->pembimbing_2 }}</td>
                        <td>{{ $jadwal_seminarta->tanggal_penjadwalan }}</td>
                        <td>{{ $jadwal_seminarta->ruangan }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcan

@can('IsDospem')
    
<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Seminar Tugas Akhir</h1>
<h1 class="h3 mb-2 text-gray-800">Tahun Akademik Semester Ganjil - 2022/2023</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Pendampingan Pembimbing 1</h6>
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
                    @foreach($jadwal_seminarta1 as $seminarta)
                    <tr>
                        {{-- @dd($seminarta) --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $seminarta->pengajuansta->npm }}</td>
                        <td>{{ $seminarta->pengajuansta->nama }}</td>
                        <td>{{ $seminarta->tanggal_penjadwalan }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-seminar/{{ $seminarta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-seminar/{{ $seminarta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Pendampingan Pembimbing 2</h6>
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
                    @foreach($jadwal_seminarta2 as $seminarta)
                    <tr>
                        {{-- @dd($seminarta) --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $seminarta->pengajuansta->npm }}</td>
                        <td>{{ $seminarta->pengajuansta->nama }}</td>
                        <td>{{ $seminarta->tanggal_penjadwalan }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="/berita-acara-seminar/{{ $seminarta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                <a href="/form-perbaikan-seminar/{{ $seminarta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
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