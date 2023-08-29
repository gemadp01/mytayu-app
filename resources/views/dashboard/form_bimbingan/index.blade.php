@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($infoMahasiswa->detailpengajuantugasakhir) --}}

<div class="card shadow mb-4 m-0">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h6 class="font-weight-bolder text-center">LAPORAN BIMBINGAN TUGAS AKHIR</h6>
                <p class="text-center">Tahun Akademik 2022/2023</p>
            </div>
            <div class="col-12">
                <ul class="list-unstyled">
                    <li>Nama Mahasiswa : {{ $infoMahasiswa->nama }}</li>
                    <li>NPM : {{ $infoMahasiswa->npm }}</li>
                    <li>Program Studi : {{ $infoMahasiswa->program_studi }}</li>
                    <li>Judul Tugas Akhir : {{ $infoMahasiswa->topik_penelitian }}</li>
                    <li>Nama Pembimbing 1 : {{ $dospem1->nama }}</li>
                    <li>Nama Pembimbing 2 : {{ $dospem2->nama }}</li>
                </ul>
            </div>
            <div class="col-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Materi Pembahasan</th>
                            <th>Hasil Saran Tugas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($bimbingans as $bimbingan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bimbingan->tanggal_bimbingan }}</td>
                            <td>{{ $bimbingan->materi_pembahasan }}</td>
                            <td>{{ $bimbingan->hasil_saran_tugas }}</td>
                            <td>
                                @if ($bimbingan->status_bimbingan === 2)
                                    <span class="badge text-bg-success">Approved</span>
                                @elseif ($bimbingan->status_bimbingan === 1)
                                    <span class="badge text-bg-warning">Waiting...</span>
                                @elseif ($bimbingan->status_bimbingan === 0)
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
    <div class="d-flex justify-content-end">
        {{ $bimbingans->links() }}
    </div>
</div>

@endsection