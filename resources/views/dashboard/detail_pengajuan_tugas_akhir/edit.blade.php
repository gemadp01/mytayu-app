@extends('dashboard.layouts.main')

@section('page-heading')
    

    @can('IsKoordinator')
        

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuanta->pengajuanta->nomor_pengajuan }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuanta->pengajuanta->tanggal_pengajuan }}</h6>
    </div>
    
    <div class="card shadow mb-4 m-0">
        <div class="card-header py-3 d-flex">
            <i class="fa fa-user pe-2" aria-hidden="true"></i>
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">NPM</li>
                        <li class="list-group-item">Nama</li>
                        <li class="list-group-item">Program Studi</li>
                        <li class="list-group-item">Kelas</li>
                        <li class="list-group-item">No HP</li>
                        <li class="list-group-item">Email</li>
                        <li class="list-group-item">Tahun Akademik</li>
                    </ul>
                </div>
                <div class="col-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->email }}</li>
                        <li class="list-group-item">Semester Ganjil - 2022/2023</li>
                    </ul>
                    
                </div>
                <div class="col-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : {{ $detailpengajuanta->pengajuanta->status_pengajuan }}</li>
                        <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemPertama->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemPertama->nama }}</li>
                        <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemKedua->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemKedua->nama }}</li>
                    </ul>
                </div>
            </div>
    
            <div class="row">
                <div class="col-8">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                        </div>
                        <div class="card-body d-flex justify-content-evenly">
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" download>Download KTM</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" download>Download KHS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" download>Download KRS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                </div>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <div class="card shadow mb-4 m-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Proposal TA</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topik Penelitian yang diajukan : </li>
                                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->topik_penelitian }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->proposal_ta) }}" download>Download Proposal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/detail-pengajuan-ta/{{ $detailpengajuanta->id }}">
                                @method('put')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_kwitansi" value="Diterima" id="kwitansi" @if ($detailpengajuanta->ket_kwitansi) checked @endif>
                                    <label class="form-check-label" for="kwitansi">
                                        Kwitansi
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_ktm" value="Diterima" id="ktm" @if ($detailpengajuanta->ket_ktm) checked @endif>
                                    <label class="form-check-label" for="ktm">
                                        KTM
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_khs" value="Diterima" id="khs" @if ($detailpengajuanta->ket_khs) checked @endif>
                                    <label class="form-check-label" for="khs">
                                        KHS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_krs" value="Diterima" id="krs" @if ($detailpengajuanta->ket_krs) checked @endif>
                                    <label class="form-check-label" for="krs">
                                        KRS
                                    </label>
                                </div>
                                
                                <div class="card shadow mb-4 m-0">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="tanggapan_koordinator" id="exampleFormControlInput1" placeholder="Berikan tanggapan..." value="{{ $detailpengajuanta->tanggapan, old('tanggapan_koordinator') }}">
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Proses Pengajuan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

    @endcan

@endsection