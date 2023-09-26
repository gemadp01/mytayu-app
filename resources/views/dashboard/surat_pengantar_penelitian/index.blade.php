@extends('dashboard.layouts.main')

@section('page-heading')
    
<h1 class="h3 mb-2 text-gray-800">List Pengajuan Surat Pengantar Penelitian Mahasiswa</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Surat Pengantar Penelitian TA</h6>
    </div>

    <div class="row">
        <div class="col mb-1 mt-3 ms-3">
            @can('IsMahasiswa')
            <a href="/dashboard/pengantar-penelitian/create" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Pengajuan Surat Pengantar</span>
            </a>
            @endcan
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No <div>Pengajuan</div></th>
                        <th>Tanggal <div>Pengajuan</div></th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Nama <div>Instansi</div></th>
                        <th>Waktu <div>Penelitian</div></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan_pengantar as $pengajuan_pp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengajuan_pp->nomor_pengajuan }}</td>
                            <td>{{ $pengajuan_pp->tanggal_pengajuan }}</td>
                            <td>{{ $pengajuan_pp->npm }}</td>
                            <td>{{ $pengajuan_pp->nama }}</td>
                            <td>{{ $pengajuan_pp->nama_instansi }}</td>
                            <td>{{ $pengajuan_pp->waktu_penelitian }}</td>
                            <td>
                                @can('IsMahasiswa')
                                    @if ($pengajuan_pp->sk_pengantar !== null)
                                    <a href="{{ asset('storage/' . $pengajuan_pp->sk_pengantar) }}" class="btn btn-primary btn-circle btn-sm" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @endif
                                @endcan

                                @can('IsAdmin')
                                    @if ($pengajuan_pp->sk_pengantar !== null)
                                        <a href="/dashboard/pengantar-penelitian/{{ $pengajuan_pp->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="/dashboard/pengantar-penelitian/{{ $pengajuan_pp->id }}/edit" class="btn btn-warning btn-circle btn-sm">
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
    </div>
    <div class="d-flex justify-content-end">
        {{ $pengajuan_pengantar->links() }}
    </div>
</div>

@endsection