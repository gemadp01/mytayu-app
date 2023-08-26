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
                    @foreach($jadwal_seminarta as $seminarta)
                    <tr>
                        {{-- @dd($seminarta) --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $seminarta->pengajuansta->npm }}</td>
                        <td>{{ $seminarta->pengajuansta->nama }}</td>
                        <td>{{ $seminarta->pengajuansta->kelas }}</td>
                        <td>{{ $seminarta->pembimbing_1 }}</td>
                        <td>{{ $seminarta->pembimbing_2 }}</td>
                        <td>{{ $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar . " - " . $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcan

@can('KaprodiDekan')
    
{{-- @dd($jadwal_seminarta) --}}

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
                        <td>{{ $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar . " - " . $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar }}</td>
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
                    
                    {{-- @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $appointment->tanggal }}</td>
                        <td>{{ $appointment->hari }}</td>
                        <td>{{ $appointment->waktu_awal . " - " . $appointment->waktu_akhir }}</td>
                        <td>{{ $appointment->jenis_pertemuan }}</td>
                        <td>{{ $appointment->keterangan }}</td>
                    </tr>
                    @endforeach --}}
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
                        <td>{{ $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar . " - " . $seminarta->tanggal_penjadwalan . " " . $seminarta->waktu_seminar }}</td>
                        <td>{{ $seminarta->ruangan }}</td>
                        <td>
                            <a href="/dashboard/penjadwalan-seminar-sidang/{{ $seminarta->id }}/edit" class="btn btn-warning btn-sm">
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
                    
                    {{-- @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $appointment->tanggal }}</td>
                        <td>{{ $appointment->hari }}</td>
                        <td>{{ $appointment->waktu_awal . " - " . $appointment->waktu_akhir }}</td>
                        <td>{{ $appointment->jenis_pertemuan }}</td>
                        <td>{{ $appointment->keterangan }}</td>
                        <td>
                            <a href="/dashboard/agenda-bimbingan/{{ $appointment->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                                Appointment
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/pengajuan-ta/{{ $appointment->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endcan

@endsection