@extends('dashboard.layouts.main')

@section('page-heading')
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Seminar Tugas Akhir</h6>
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
                        
                        @foreach($pengajuanseminartas as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->no_pengajuan_seminar }}</td>
                            <td>{{ $pta->tanggal_pengajuan }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>{{ $pta->kelas }}</td>
                            <td>{{ $pta->email }}</td>
                            <td>
                                {{-- @if ($pta->status_pengajuan_seminar === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($pta->status_pengajuan_seminar === 1)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif --}}
                                @if ($pta->status_pengajuan_seminar === 0)
                                    <span class="badge text-bg-danger text-start">revisi...</span>
                                @elseif ($pta->status_pengajuan_seminar === 1)
                                    <span class="badge text-bg-warning text-start">belum diperiksa...</span>
                                @elseif ($pta->status_pengajuan_seminar === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($pta->status_pengajuan_seminar === 4)
                                    <span class="badge text-bg-success text-start">Pengajuan Diterima...</span>
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuanseminartas->links() }}
            </div>
        </div>
    </div>

@endsection