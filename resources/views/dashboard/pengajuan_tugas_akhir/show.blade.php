@extends('dashboard.layouts.main')

@section('page-heading')
    
{{-- @dd($detailpengajuanta->detailpengajuantugasakhir)detaildetail --}}

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
                        @else
                            <span class="badge text-bg-success">diterima...</span>
                        @endif
                    </li>
                    <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                    <li class="list-group-item">{{ "( ". ($detailpengajuanta->usulanDospemPertama->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->usulanDospemPertama->nama ?? 'Default nama') }}</li>
                    <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                    <li class="list-group-item">{{ "( ". ($detailpengajuanta->usulanDospemKedua->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->usulanDospemKedua->nama ?? 'Default nama') }}</li>

                    @if ($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiPertama && $detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiKedua)
                    <li class="list-group-item">Usulan Pembimbing 1 dari Kaprodi :</li>
                    <li class="list-group-item">{{ "( ". ($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiPertama->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiPertama->nama ?? 'Default nama') }}</li>
                    <li class="list-group-item">Usulan Pembimbing 2 dari Kaprodi :</li>
                    <li class="list-group-item">{{ "( ". ($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiKedua->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiKedua->nama ?? 'Default nama') }}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="row flex-column flex-lg-row">
            <div class="col-12 col-lg-4">
                <div class="row flex-column mw-100">
                    <div class="col-12">
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tanggapan Koordinator KP/TA</h6>
                            </div>
                            <div class="card-body">
                                @if ($detailpengajuanta->detailpengajuantugasakhir->tanggapan)
                                <p>
                                    {{ $detailpengajuanta->detailpengajuantugasakhir->tanggapan }}
                                </p>
                                @else
                                <p>
                                    ...
                                </p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
        
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
                        <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="row justify-content-evenly">
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuanta->foto_kwitansi)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuanta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                        @if ($detailpengajuanta->detailpengajuantugasakhir->ket_kwitansi)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuanta->detailpengajuantugasakhir->ket_kwitansi)
                                <div class="card" style="width: 10rem;">
                                    Image not found!
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                    </div>
                                </div>  
                                @else
                                <div class="card" style="width: 10rem;">
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-danger">
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_kwitansi)
                                                Revisi
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuanta->foto_ktm)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuanta->foto_ktm) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_ktm) }}" download>Download KTM</a>
                                        @if ($detailpengajuanta->detailpengajuantugasakhir->ket_ktm)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuanta->detailpengajuantugasakhir->ket_ktm)
                                <div class="card" style="width: 10rem;">
                                    Image not found!
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                    </div>
                                </div>  
                                @else
                                <div class="card" style="width: 10rem;">
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-danger">
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_ktm)
                                                Revisi
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuanta->foto_khs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuanta->foto_khs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_khs) }}" download>Download KHS</a>
                                        @if ($detailpengajuanta->detailpengajuantugasakhir->ket_khs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuanta->detailpengajuantugasakhir->ket_khs)
                                <div class="card" style="width: 10rem;">
                                    Image not found!
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                    </div>
                                </div>  
                                @else
                                <div class="card" style="width: 10rem;">
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-danger">
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_khs)
                                                Revisi
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
    
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuanta->foto_krs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuanta->foto_krs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_krs) }}" download>Download KRS</a>
                                        @if ($detailpengajuanta->detailpengajuantugasakhir->ket_krs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuanta->detailpengajuantugasakhir->ket_krs)
                                <div class="card" style="width: 10rem;">
                                    Image not found!
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                    </div>
                                </div>  
                                @else
                                <div class="card" style="width: 10rem;">
                                    <div class="card-body text-center">
                                        <span class="badge text-bg-danger">
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_krs)
                                                Revisi
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>      
            </div>
        </div>

        

    </div>
</div>

@endsection