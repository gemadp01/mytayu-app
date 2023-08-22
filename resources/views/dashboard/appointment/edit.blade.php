@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsDospem')
<h1 class="h3 mb-2 text-gray-800">Data Bimbingan Mahasiswa Tugas Akhir</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
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
                        <th>Waktu Pertemuan</th>
                        <th>Nama</th>
                        <th>Materi Pembahasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($databimbingan->bimbingan) --}}
                    @foreach($databimbingan->bimbingan as $mahasiswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mahasiswa->jam_awal . " - " . $mahasiswa->jam_akhir}}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->materi_pembahasan }}</td>
                        <td>
                            @if ($mahasiswa->status_bimbingan === 1)
                                <span class="badge text-bg-warning">waiting...</span>
                            @elseif ($mahasiswa->status_bimbingan === 2)
                                <span class="badge text-bg-success">Approved...</span>
                            @else
                                <span class="badge text-bg-danger">Declined!</span>
                            @endif
                        </td>
                        <td>
                            @if ($mahasiswa->status_bimbingan === 1)
                            
                            <div class="d-flex">
                                <a href="/dashboard/bimbingan/{{ $mahasiswa->id }}/edit" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
    
                                <form method="post" action="/dashboard/bimbingan/{{ $mahasiswa->id }}/declined-bimbingan">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </div>

                            @elseif ($mahasiswa->status_bimbingan === 2)
                            <form method="post" action="/dashboard/bimbingan/{{ $mahasiswa->id }}/declined-bimbingan">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                            @endif
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
<h1 class="h3 mb-2 text-gray-800">Pengajuan Appointment Bimbingan</h1>


<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        Hari {{ $appointment->hari }}, {{ $appointment->tanggal }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">
        {{ $appointment->dosen->nama }}
    </h6>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Appointment</h6>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col mb-1">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>
                    Agendakan Pertemuan
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
                        <th>Waktu Pertemuan</th>
                        <th>Materi Bimbingan</th>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($dataappointment->bimbingan) --}}
                    @foreach($dataappointment as $mahasiswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mahasiswa->jam_awal . " - " . $mahasiswa->jam_akhir}}</td>
                        <td>{{ $mahasiswa->materi_pembahasan }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>
                            @if ($mahasiswa->status_bimbingan === 1)
                                <span class="badge text-bg-warning">waiting...</span>
                            @elseif ($mahasiswa->status_bimbingan === 2)
                                <span class="badge text-bg-success">Approved...</span>
                            @else
                                <span class="badge text-bg-danger">Declined!</span>
                            @endif
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