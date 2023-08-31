@extends('dashboard.layouts.main')

@section('page-heading')
    
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengajuan Sidang Tugas Akhir</h6>
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
                    
                    @foreach($pengajuansidangtas as $psta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $psta->no_pengajuan_sidang }}</td>
                        <td>{{ $psta->tanggal_pengajuan }}</td>
                        <td>{{ $psta->npm }}</td>
                        <td>{{ $psta->nama }}</td>
                        <td>{{ $psta->program_studi }}</td>
                        <td>{{ $psta->kelas }}</td>
                        <td>{{ $psta->email }}</td>
                        <td>
                            @if ($psta->status_pengajuan_sidang === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($psta->status_pengajuan_sidang === 1)
                                <span class="badge text-bg-warning">belum diperiksa...</span>
                            @else
                                <span class="badge text-bg-success">diterima...</span>
                            @endif
                        </td>
                        <td class="text-center">
    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $pengajuansidangtas->links() }}
        </div>
    </div>
</div>

@endsection