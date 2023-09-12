@extends('dashboard.layouts.main')

@section('page-heading')
    
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (auth()->user()->pengajuansidangta->count() > 0)
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
                            <td>
                            @if ($penilaian_sidangta !== null)
                                <div class="d-flex flex-column">
                                    <a href="/berita-acara-sidang/{{ $jadwal_sidangta->id }}" class="btn btn-outline-primary mb-1">Berita Acara</a>
                                    <a href="/form-perbaikan-sidang/{{ $jadwal_sidangta->id }}" class="btn btn-outline-primary">Form Perbaikan</a>
                                </div>
                            @endif
                            </td>
                        </tr>
                        @endif
                    @else
                        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection