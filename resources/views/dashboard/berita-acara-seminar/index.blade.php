@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($penilaian_seminar->penjadwalansta) --}}

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $infoSeminar->pengajuansta->no_pengajuan_seminar }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $infoSeminar->pengajuansta->tanggal_pengajuan }}</h6>
</div>
<div class="card shadow mb-4 m-0">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h6 class="font-weight-bolder text-center">BERITA ACARA SEMINAR TUGAS AKHIR</h6>
                <p class="text-center">Tahun Akademik 2022/2023</p>
            </div>
            <div class="col-12">
                <p>Dengan ini menyatakan bahwa pada tanggal {{ $infoSeminar->tanggal_approve_seminarta }} pukul {{ $tanggal_waktu[1] }} dengan tempat di {{ $infoSeminar->ruangan }} telah dilaksanakan seminar tugas akhir untuk:</p>
            </div>
            <div class="col-12">
                <ul class="list-unstyled">
                    <li>Nama Mahasiswa : {{ $infoSeminar->pengajuansta->nama }}</li>
                    <li>NPM : {{ $infoSeminar->pengajuansta->npm }}</li>
                    <li>Program Studi : {{ $infoSeminar->pengajuansta->program_studi }}</li>
                    <li>Judul Tugas Akhir : {{ $infoSeminar->pengajuansta->judul_smta }}</li>
                </ul>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dosen Penguji</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $dospem1->nama }}</td>
                                <td>
                                    @if (!$penilaian_seminar->approve_pembimbing1)
                                        @if (auth()->user()->id === $dospem1->user_id)
                                        <form method="post" action="/dashboard/penilaian-seminar/{{ $penilaian_seminar->id }}">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">Approve</button>
                                        </form>
                                        @endif
                                    @elseif ($penilaian_seminar->approve_pembimbing1)
                                    <span class="badge text-bg-success">
                                        Approved...
                                    </span>
                                    @endif

                                    @can('IsMahasiswa')
                                        @if ($penilaian_seminar->approve_pembimbing1 === 0)
                                        <span class="badge text-bg-warning">
                                            Waiting...
                                        </span>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>{{ $dospem2->nama }}</td>
                                <td>
                                    @if (!$penilaian_seminar->approve_pembimbing2)
                                        @if (auth()->user()->id === $dospem2->user_id)
                                        <form method="post" action="/dashboard/penilaian-seminar/{{ $penilaian_seminar->id }}">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">Approve</button>
                                        </form>
                                        @endif
                                    @elseif ($penilaian_seminar->approve_pembimbing2)
                                    <span class="badge text-bg-success">
                                        Approved...
                                    </span>
                                    
                                    @endif

                                    @can('IsMahasiswa')
                                        @if ($penilaian_seminar->approve_pembimbing2 === 0)
                                        <span class="badge text-bg-warning">
                                            Waiting...
                                        </span>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection