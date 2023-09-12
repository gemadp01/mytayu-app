@extends('dashboard.layouts.main')

@section('page-heading')
    
{{-- @dd($detailpengajuan_sidang) --}}

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $detailpengajuan_sidang->no_pengajuan_sidang }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_sidang->tanggal_pengajuan }}</h6>
</div>

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3 d-flex">
        <i class="fa fa-user pe-2" aria-hidden="true"></i>
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Sidang Tugas Akhir</h6>
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
                    <li class="list-group-item">{{ $detailpengajuan_sidang->npm }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_sidang->nama }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_sidang->program_studi }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_sidang->kelas }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_sidang->nomor_telepon }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_sidang->email }}</li>
                    <li class="list-group-item">Semester Ganjil - 2022/2023</li>
                </ul>
                
            </div>
            <div class="col-12 col-lg-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Pengajuan : 
                        @if ($detailpengajuan_sidang->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($detailpengajuan_sidang->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
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
                                <h6 class="m-0 font-weight-bold text-primary">Tanggapan Koordinator KP/TA</h6>
                            </div>
                            <div class="card-body">
                                @if ($detailpengajuan_sidang->detailpengajuansidangta->tanggapan)
                                <p>
                                    {{ $detailpengajuan_sidang->detailpengajuansidangta->tanggapan }}
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
                                <h6 class="m-0 font-weight-bold text-primary">Lampiran Draft Laporan TA</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Judul Penelitian yang ditempuh : </li>
                                    <li class="list-group-item">{{ $detailpengajuan_sidang->judul_sdta }}</li>
                                    <li class="list-group-item">
                                        @if ($detailpengajuan_sidang->draft_laporan)
                                        <a href="{{ asset('storage/' . $detailpengajuan_sidang->draft_laporan) }}" download>Download Draft Laporan</a>
                                        @else
                                        <span class="badge text-bg-danger">
                                            Revisi
                                        </span>
                                        <strong>
                                            Draft Laporan
                                        </strong>
                                        @endif
                                        
                                    </li>
                                    <li class="list-group-item">
                                        @if ($detailpengajuan_sidang->sk_pembimbing)
                                        <a href="{{ asset('storage/' . $detailpengajuan_sidang->sk_pembimbing) }}" download>Download SK Pembimbing</a>
                                        @else
                                        <span class="badge text-bg-danger">
                                            Revisi
                                        </span>
                                        <strong>
                                            SK Pembimbing
                                        </strong>
                                        @endif
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lampiran Tambahan</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Laporan Pembimbing 1 : </li>

                                    <li class="list-group-item">
                                        <a href="/form-bimbingan/{{ $detailpengajuan_sidang->user_id }}/{{ $dospem1->id }}">
                                            Lembar Bimbingan Pembimbing 1
                                        </a>
                                    </li>

                                    <li class="list-group-item">Laporan Pembimbing 2 : </li>

                                    <li class="list-group-item">
                                        <a href="/form-bimbingan/{{ $detailpengajuan_sidang->user_id }}/{{ $dospem2->id }}">
                                            Lembar Bimbingan Pembimbing 2
                                        </a>
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
                            <div class="col-12 col-sm-5 col-md-3 col-lg-5 col-xl-2">
                                @if ($detailpengajuan_sidang->foto_kwitansi_wisuda)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->foto_kwitansi_wisuda) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->foto_kwitansi_wisuda) }}" download>Download Kwitansi Wisuda</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_wisuda)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_wisuda)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_wisuda)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Kwitansi Wisuda
                                            </strong>
                                        </p>
                                        
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12 col-sm-5 col-md-3 col-lg-5 col-xl-2">
                                @if ($detailpengajuan_sidang->foto_kwitansi_ta)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->foto_kwitansi_ta) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->foto_kwitansi_ta) }}" download>Download Kwitansi TA</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_ta)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_ta)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_kwitansi_ta)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Kwitansi TA
                                            </strong>
                                        </p>
                                        
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->khs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->khs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->khs) }}" download>Download KHS</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_khs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_khs)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_khs)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                KHS
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
    
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->krs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->krs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->krs) }}" download>Download KRS</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_krs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_krs)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_krs)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                KRS
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->ktm)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->ktm) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->ktm) }}" download>Download KTM</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ktm)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ktm)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ktm)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                KTM
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        

                        <div class="row justify-content-evenly">
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->lembar_persetujuan_sidang)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->lembar_persetujuan_sidang) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->lembar_persetujuan_sidang) }}" download>Download Lembar Persetujuan Seminar</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_persetujuan_sidang)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_persetujuan_sidang)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_persetujuan_sidang)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Persetujuan Sidang TA
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->sbb)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->sbb) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->sbb) }}" download>Download Lembar SBB Pendidikan</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_pendidikan)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_pendidikan)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_pendidikan)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                SBB Pendidikan
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->sbb_perpustakaan)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->sbb_perpustakaan) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->sbb_perpustakaan) }}" download>Download Lembar Surat Bebas Biaya Perpustakaan</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_perpustakaan)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_perpustakaan)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_sbb_perpustakaan)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Surat Bebas Biaya Perpustakaan
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>

                        <div class="row justify-content-evenly">
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->foto_ijazah_sma)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->foto_ijazah_sma) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->foto_ijazah_sma) }}" download>Download Foto Ijazah</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ijazah)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ijazah)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_ijazah)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Persetujuan Sidang TA
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->sertifikat_pkkmb)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->sertifikat_pkkmb) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->sertifikat_pkkmb) }}" download>Download Sertifikat PKKMB</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_pkkmb)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_pkkmb)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_pkkmb)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Persetujuan Sidang TA
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_sidang->sertifikat_toefl)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_sidang->sertifikat_toefl) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidang->sertifikat_toefl) }}" download>Download Sertifikat TOEFL</a>
                                        @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_toefl)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_toefl)
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
                                            @if (!$detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_toefl)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Persetujuan Sidang TA
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>


                        <div class="row justify-content-evenly">
                            
                            @if ($detailpengajuan_sidang->sertifikat_kegiatan)
                                @foreach(json_decode($detailpengajuan_sidang->sertifikat_kegiatan) as $sertifikat)

                                <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                    @if ($sertifikat)
                                    <div class="card h-auto" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $sertifikat) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $sertifikat) }}" download>Download Sertifikat Kegiatan {{ $loop->iteration }}</a>
                                            @if ($detailpengajuan_sidang->detailpengajuansidangta->ket_lampiran_sertifikat_kegiatan)
                                            <span class="badge text-bg-success">
                                                Diterima
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                
                            
                                </div>
                                
                                @endforeach
                            @else
                            <span class="badge text-bg-danger">
                                Revisi
                            </span>
                            <p class="text-center">
                                <strong>
                                    Sertifikat Kegiatan
                                </strong>
                            </p>
                            @endif

                            

                        </div>

                    </div>
                </div>      
            </div>
        </div>

        

    </div>
</div>

@endsection