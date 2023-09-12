@extends('dashboard.layouts.main')

@section('page-heading')

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuanta->nomor_pengajuan }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuanta->tanggal_pengajuan }}</h6>
    </div>

    <div class="card shadow mb-4 m-0">
        <div class="card-header py-3 d-flex">
            <i class="fa fa-user pe-2" aria-hidden="true"></i>
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-md-6 col-lg-3">
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
                <div class="col-7 col-md-6 col-lg-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $detailpengajuanta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->email }}</li>
                        <li class="list-group-item">Semester Ganjil - 2022/2023</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuanta->status_pengajuan === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuanta->status_pengajuan === 1)
                                <span class="badge text-bg-warning">belum diperiksa...</span>
                            @elseif ($detailpengajuanta->status_pengajuan === 2)
                                <span class="badge text-bg-success">diterima...</span>
                            @else
                                <span class="badge text-bg-success">diterima...</span>

                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row flex-column flex-lg-row">
                <div class="col-12 col-lg-4">
                    <div class="row flex-column mw-100">
            
                        <div class="col-12">
                            <div class="card shadow mb-4 m-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Proposal TA</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topik Penelitian yang diajukan : </li>
                                        <li class="list-group-item">{{ $detailpengajuanta->topik_penelitian }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuanta->proposal_ta) }}" download>Download Proposal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Upload SK TA</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/daftar-mahasiswa-ta/{{ $detailpengajuanta->id }}">
                                @method('put')
                                @csrf
                                <div>
                                    <label for="sk_ta">Upload SK TA</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="sk_ta" id="sk_ta">
                                      @if (!empty($detailpengajuanta->sk_ta_id))
                                        <option selected>{{ $detailpengajuanta->suratketeranganta->nama }}</option>
                                      @else
                                        <option selected>Choose...</option>
                                        @foreach ($list_sk_ta as $sk_ta)
                                            <option value="{{ $sk_ta->id }}">{{ $sk_ta->nama }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Upload SK TA</button>
                                </div>
                            </form>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>

@endsection