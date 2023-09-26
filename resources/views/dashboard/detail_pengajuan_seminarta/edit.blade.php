@extends('dashboard.layouts.main')

@section('page-heading')
    
    @can('IsKoordinator')
    {{-- @dd($detailpengajuan_seminarta->pengajuanseminarta) --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuan_seminarta->pengajuanseminarta->no_pengajuan_seminar }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_seminarta->pengajuanseminarta->tanggal_pengajuan }}</h6>
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
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->email }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->tahun_akademik }}</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuan_seminarta->pengajuanseminarta->status_pengajuan_seminar === 0)
                                <span class="badge text-bg-danger text-start">revisi...</span>
                            @elseif ($detailpengajuan_seminarta->pengajuanseminarta->status_pengajuan_seminar === 1)
                                <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator...</div></span>
                            @elseif ($detailpengajuan_seminarta->pengajuanseminarta->status_pengajuan_seminar === 3)
                                <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                            @elseif ($detailpengajuan_seminarta->pengajuanseminarta->status_pengajuan_seminar === 4)
                                <span class="badge text-bg-success text-start">Pengajuan Diterima...</span>
                            @endif
                        </li>
                        {{-- <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuan_seminarta->pengajuanseminarta->usulanDospemPertama->singkatan ." ) " . $detailpengajuan_seminarta->pengajuanseminarta->usulanDospemPertama->nama }}</li>
                        <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuan_seminarta->pengajuanseminarta->usulanDospemKedua->singkatan ." ) " . $detailpengajuan_seminarta->pengajuanseminarta->usulanDospemKedua->nama }}</li> --}}
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                        </div>
                        <div class="card-body d-flex justify-content-evenly">
                            <div class="row justify-content-evenly">
                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_khs) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_khs) }}" download>Download KHS</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_krs) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_krs) }}" download>Download KRS</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_persetujuan_seminarta) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_persetujuan_seminarta) }}" download>Download Lembar Persetujuan Seminar TA</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_bimbingan1) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_bimbingan1) }}" download>Download Lembar Bimbingan 1</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-5 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_bimbingan2) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->lembar_bimbingan2) }}" download>Download Lembar Bimbingan 2</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-evenly">
                                    @foreach(json_decode($detailpengajuan_seminarta->pengajuanseminarta->sertifikat_kegiatan) as $sertifikat)
    
                                    <div class="card" style="width: 10rem;">
                                        @if ($detailpengajuan_seminarta->pengajuanseminarta->sertifikat_kegiatan)
                                        <div class="card h-auto" style="width: 10rem;">
                                            <img src="{{ asset('storage/' . $sertifikat) }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <a class="card-text" href="{{ asset('storage/' . $sertifikat) }}" download>Download Sertifikat Kegiatan {{ $loop->iteration }}</a>
                                                @if ($detailpengajuan_seminarta->pengajuanseminarta->ket_lembar_bimbingan2)
                                                <span class="badge text-bg-success">
                                                    Diterima
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
    
                                    @endforeach
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
                                        <li class="list-group-item">{{ $detailpengajuan_seminarta->pengajuanseminarta->judul_smta }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->draft_laporan) }}" download>Download Draft Laporan</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuan_seminarta->pengajuanseminarta->sk_ta) }}" download>Download SK TA</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/detail-pengajuan-seminarta/{{ $detailpengajuan_seminarta->id }}">
                                @method('put')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_kwitansi" value="Diterima" id="kwitansi" @if ($detailpengajuan_seminarta->ket_kwitansi) checked @endif>
                                    <label class="form-check-label" for="kwitansi">
                                        Kwitansi
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_khs" value="Diterima" id="khs" @if ($detailpengajuan_seminarta->ket_khs) checked @endif>
                                    <label class="form-check-label" for="khs">
                                        KHS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_krs" value="Diterima" id="krs" @if ($detailpengajuan_seminarta->ket_krs) checked @endif>
                                    <label class="form-check-label" for="krs">
                                        KRS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_sk_ta" value="Diterima" id="ket_sk_ta" @if ($detailpengajuan_seminarta->ket_sk_ta) checked @endif>
                                    <label class="form-check-label" for="ket_sk_ta">
                                        SK TA
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_persetujuan_seminarta" value="Diterima" id="ket_persetujuan_seminarta" @if ($detailpengajuan_seminarta->ket_persetujuan_seminarta) checked @endif>
                                    <label class="form-check-label" for="ket_persetujuan_seminarta">
                                        Lembar Persetujuan Seminar Tugas Akhir
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lembar_bimbingan1" value="Diterima" id="ket_lembar_bimbingan1" @if ($detailpengajuan_seminarta->ket_lembar_bimbingan1) checked @endif>
                                    <label class="form-check-label" for="ket_lembar_bimbingan1">
                                        Lembar Bimbingan 1
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lembar_bimbingan2" value="Diterima" id="ket_lembar_bimbingan2" @if ($detailpengajuan_seminarta->ket_lembar_bimbingan2) checked @endif>
                                    <label class="form-check-label" for="ket_lembar_bimbingan2">
                                        Lembar Bimbingan 2
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_sertifikat_kegiatan" value="Diterima" id="ket_sertifikat_kegiatan" @if ($detailpengajuan_seminarta->ket_sertifikat_kegiatan) checked @endif>
                                    <label class="form-check-label" for="ket_sertifikat_kegiatan">
                                        Sertifikat Kegiatan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_draft_laporan" value="Diterima" id="ket_draft_laporan" @if ($detailpengajuan_seminarta->ket_draft_laporan) checked @endif>
                                    <label class="form-check-label" for="ket_draft_laporan">
                                        Draft Laporan
                                    </label>
                                </div>
                                
                                <div class="card shadow mb-4 m-0">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="tanggapan" id="exampleFormControlInput1" placeholder="Berikan tanggapan..." value="{{ $detailpengajuan_seminarta->tanggapan, old('tanggapan') }}">
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