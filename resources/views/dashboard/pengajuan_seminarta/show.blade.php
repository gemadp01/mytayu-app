@extends('dashboard.layouts.main')

@section('page-heading')
    
{{-- @dd($detailpengajuan_seminarta->detailpengajuanseminarta) --}}

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $detailpengajuan_seminarta->no_pengajuan_seminar }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_seminarta->tanggal_pengajuan }}</h6>
</div>

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="w-25">
            <i class="fa fa-user pe-2" aria-hidden="true"></i>
            <h6 class="m-0 font-weight-bold text-primary d-inline">Detail Pengajuan Seminar Tugas Akhir</h6>
        </div>
        @if($detailpengajuan_seminarta->detailpengajuanseminarta->tanggal_penerimaan !== null)
            <h6 class="m-0 font-weight-bold text-primary">
                Tanggal Penerimaan : {{ $detailpengajuan_seminarta->detailpengajuanseminarta->tanggal_penerimaan }}
            </h6>
        @endif
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
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->npm }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->nama }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->program_studi }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->kelas }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->nomor_telepon }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->email }}</li>
                    <li class="list-group-item">{{ $detailpengajuan_seminarta->tahun_akademik }}</li>
                </ul>
                
            </div>
            <div class="col-12 col-lg-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Pengajuan : 
                        {{-- @if ($detailpengajuan_seminarta->status_pengajuan_seminar === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
                        @else
                            <span class="badge text-bg-success">diterima...</span>
                        @endif --}}
                        @if ($detailpengajuan_seminarta->status_pengajuan_seminar === 0)
                            <span class="badge text-bg-danger text-start">revisi...</span>
                        @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 1)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator...</div></span>
                        @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 3)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                        @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 4)
                            <span class="badge text-bg-success text-start">Pengajuan Diterima...</span>
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
                                @if ($detailpengajuan_seminarta->detailpengajuanseminarta->tanggapan)
                                <p>
                                    {{ $detailpengajuan_seminarta->detailpengajuanseminarta->tanggapan }}
                                </p>
                                @else
                                <p>
                                    ...
                                </p>
                                @endif
                                
                            </div>
                        </div>
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Tanggapan Koordinator</h6>
                            </div>
                            <div class="card-body">
                                @if ($detailpengajuan_seminarta->detailpengajuanseminarta->tanggapan_data)
                                <ol class="list-group list-group-numbered">
                                    @foreach(json_decode($detailpengajuan_seminarta->detailpengajuanseminarta->tanggapan_data) as $tanggapan)
                                        <li class="list-group-item">{{ $tanggapan }}</li>
                                    @endforeach
                                    
                                </ol>
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
                                    <li class="list-group-item">{{ $detailpengajuan_seminarta->judul_smta }}</li>
                                    <li class="list-group-item">
                                        @if ($detailpengajuan_seminarta->draft_laporan)
                                        <a href="{{ asset('storage/' . $detailpengajuan_seminarta->draft_laporan) }}" download>Download Draft Laporan</a>
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
                                        @if ($detailpengajuan_seminarta->sk_ta)
                                        <a href="{{ asset('storage/' . $detailpengajuan_seminarta->sk_ta) }}" download>Download SK TA</a>    
                                        @else
                                            <span class="badge text-bg-danger">
                                                Revisi
                                            </span>
                                            
                                            <strong>
                                                SK TA
                                            </strong>
                                            
                                        @endif
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
                                @if ($detailpengajuan_seminarta->foto_kwitansi)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_kwitansi)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_kwitansi)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_kwitansi)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Kwitansi
                                            </strong>
                                        </p>
                                        
                                    </div>
                                </div>
                                @endif
                            </div>                        
                            
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_seminarta->foto_khs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->foto_khs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->foto_khs) }}" download>Download KHS</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_khs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_khs)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_khs)
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
                                @if ($detailpengajuan_seminarta->foto_krs)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->foto_krs) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->foto_krs) }}" download>Download KRS</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_krs)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_krs)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_krs)
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
                        </div>

                        

                        <div class="row justify-content-evenly">
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_seminarta->lembar_persetujuan_seminarta)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_persetujuan_seminarta) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_persetujuan_seminarta) }}" download>Download Lembar Persetujuan Seminar</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_persetujuan_seminarta)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_persetujuan_seminarta)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_persetujuan_seminarta)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Persetujuan Seminar TA
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_seminarta->lembar_bimbingan1)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_bimbingan1) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_bimbingan1) }}" download>Download Lembar Bimbingan 1</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan1)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan1)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan1)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Lembar Bimbingan 1
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                @if ($detailpengajuan_seminarta->lembar_bimbingan2)
                                <div class="card h-auto" style="width: 10rem;">
                                    <img src="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_bimbingan2) }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->lembar_bimbingan2) }}" download>Download Lembar Bimbingan 2</a>
                                        @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan2)
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan2)
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
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta->ket_lembar_bimbingan2)
                                                Revisi
                                            @endif
                                        </span>
                                        <p>
                                            <strong>
                                                Lembar Bimbingan 2
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>


                        <div class="row justify-content-evenly">
                            
                            @if ($detailpengajuan_seminarta->sertifikat_kegiatan)
                                @foreach(json_decode($detailpengajuan_seminarta->sertifikat_kegiatan) as $sertifikat)

                                <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                    @if ($sertifikat)
                                    <div class="card h-auto" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $sertifikat) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $sertifikat) }}" download>Download Sertifikat Kegiatan {{ $loop->iteration }}</a>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta->ket_sertifikat_kegiatan)
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