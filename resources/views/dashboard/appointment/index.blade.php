@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsDospem')
    <h1 class="h3 mb-2 text-gray-800">Counseling Appointment</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal Agenda Kegiatan Bimbingan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col mb-1">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        Buat Agenda Bimbingan
                    </button>
                    
                    @include('dashboard.appointment.create')
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
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Jenis Pertemuan</th>
                            <th>Keterangan</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($appointments as $appointment)
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
                            {{-- <td class="text-center">
                                <a href="/dashboard/pengajuan-ta/{{ $appointment->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endcan

@can('IsMahasiswa')
    
<h1 class="h3 mb-2 text-gray-800">Appointment Bimbingan Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Appointment Bimbingan</h6>
    </div>
    <div class="card-body">

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
                        <th>Hari</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Jenis Pertemuan</th>
                        <th>Keterangan</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $appointment->hari }}</td>
                        <td>{{ $appointment->tanggal }}</td>
                        <td>{{ $appointment->jenis_pertemuan }}</td>
                        <td>{{ $appointment->keterangan }}</td>
                        <td>
                            <a href="/dashboard/agenda-bimbingan/{{ $appointment->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                                Appointment
                            </a>
                        </td>
                        {{-- <td class="text-center">
                            <a href="/dashboard/pengajuan-ta/{{ $appointment->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcan

    
@endsection