@extends('dashboard.layouts.main')

@section('page-heading')
    
    @can('IsKoordinator')
    
    {{-- @dd($detailpengajuan_sidangta) --}}

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuan_sidangta->pengajuansidangta->no_pengajuan_sidang }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_sidangta->pengajuansidangta->tanggal_pengajuan }}</h6>
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
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->email }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->tahun_akademik }}</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            {{-- @if ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 2)
                            <span class="badge text-bg-success">diterima...</span>
                            @endif --}}
                            @if ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 1)
                                <span class="badge text-bg-warning">belum diperiksa oleh Koordinator KP/TA...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 2)
                                <span class="badge text-bg-warning">belum diperiksa oleh Kaprodi...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 3)
                                <span class="badge text-bg-warning">belum diperiksa oleh Dekan...</span>
                            @elseif ($detailpengajuan_sidangta->pengajuansidangta->status_pengajuan_sidang === 4)
                                <span class="badge text-bg-success">Pengajuan Diterima...</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-9 col-xl-9">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                        </div>
                        <div class="card-body d-flex justify-content-evenly">
                            <div class="row justify-content-evenly">
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_kwitansi_wisuda) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_kwitansi_wisuda) }}" download>Download Kwitansi Wisuda</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_kwitansi_ta) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_kwitansi_ta) }}" download>Download Kwitansi TA</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->khs) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->khs) }}" download>Download KHS</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->krs) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->krs) }}" download>Download KRS</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->ktm) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->ktm) }}" download>Download KRS</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->lembar_persetujuan_sidang) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->lembar_persetujuan_sidang) }}" download>Download Lembar Persetujuan Sidang TA</a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sbb) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sbb) }}" download>Download Lembar SBB Pendidikan</a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sbb_perpustakaan) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sbb_perpustakaan) }}" download>Download Lembar SBB Perpustakaan</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_ijazah_sma) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->foto_ijazah_sma) }}" download>Download Foto Ijazah SMA</a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sertifikat_pkkmb) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sertifikat_pkkmb) }}" download>Download Sertifikat PKKMB</a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sertifikat_toefl) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sertifikat_toefl) }}" download>Download Sertifikat TOEFL</a>
                                        </div>
                                    </div>
                                </div>

                                @foreach(json_decode($detailpengajuan_sidangta->pengajuansidangta->sertifikat_kegiatan) as $sertifikat)
    
                                <div class="card" style="width: 10rem;">
                                    @if ($detailpengajuan_sidangta->pengajuansidangta->sertifikat_kegiatan)
                                    <div class="card h-auto" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $sertifikat) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $sertifikat) }}" download>Download Sertifikat Kegiatan {{ $loop->iteration }}</a>
                                            @if ($detailpengajuan_sidangta->pengajuansidangta->ket_lembar_bimbingan2)
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
                        <div class="card-body">
                            <div class="card shadow mb-4 m-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Proposal TA</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topik Penelitian yang diajukan : </li>
                                        <li class="list-group-item">{{ $detailpengajuan_sidangta->pengajuansidangta->judul_sdta }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->draft_laporan) }}" download>Download Draft Laporan</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/form-bimbingan/{{ $detailpengajuan_sidangta->pengajuansidangta->user_id }}/{{ $dospem1->id }}">
                                                Hasil Laporan Bimbingan 1
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="/form-bimbingan/{{ $detailpengajuan_sidangta->pengajuansidangta->user_id }}/{{ $dospem2->id }}">
                                                Hasil Laporan Bimbingan 2
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuan_sidangta->pengajuansidangta->sk_pembimbing) }}" download>SK Pembimbing</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/detail-pengajuan-sidangta/{{ $detailpengajuan_sidangta->id }}">
                                @method('put')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_kwitansi_wisuda" value="Diterima" id="kwitansi_wisuda" @if ($detailpengajuan_sidangta->ket_lampiran_kwitansi_wisuda) checked @endif>
                                    <label class="form-check-label" for="kwitansi_wisuda">
                                        Kwitansi Wisuda
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_kwitansi_ta" value="Diterima" id="kwitansi_ta" @if ($detailpengajuan_sidangta->ket_lampiran_kwitansi_ta) checked @endif>
                                    <label class="form-check-label" for="kwitansi_ta">
                                        Kwitansi TA
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_khs" value="Diterima" id="khs" @if ($detailpengajuan_sidangta->ket_lampiran_khs) checked @endif>
                                    <label class="form-check-label" for="khs">
                                        KHS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_krs" value="Diterima" id="krs" @if ($detailpengajuan_sidangta->ket_lampiran_krs) checked @endif>
                                    <label class="form-check-label" for="krs">
                                        KRS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_ktm" value="Diterima" id="ktm" @if ($detailpengajuan_sidangta->ket_lampiran_ktm) checked @endif>
                                    <label class="form-check-label" for="ktm">
                                        KTM
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_sk_pembimbing" value="Diterima" id="ket_lampiran_sk_pembimbing" @if ($detailpengajuan_sidangta->ket_lampiran_sk_pembimbing) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_sk_pembimbing">
                                        SK TA
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_persetujuan_sidang" value="Diterima" id="ket_persetujuan_sidang" @if ($detailpengajuan_sidangta->ket_persetujuan_sidang) checked @endif>
                                    <label class="form-check-label" for="ket_persetujuan_sidang">
                                        Lembar Persetujuan Sidang Tugas Akhir
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_bimbingan1" value="Diterima" id="ket_lampiran_bimbingan1" @if ($detailpengajuan_sidangta->ket_lampiran_bimbingan1) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_bimbingan1">
                                        Lembar Bimbingan 1
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_bimbingan2" value="Diterima" id="ket_lampiran_bimbingan2" @if ($detailpengajuan_sidangta->ket_lampiran_bimbingan2) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_bimbingan2">
                                        Lembar Bimbingan 2
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_sertifikat_kegiatan" value="Diterima" id="ket_lampiran_sertifikat_kegiatan" @if ($detailpengajuan_sidangta->ket_lampiran_sertifikat_kegiatan) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_sertifikat_kegiatan">
                                        Sertifikat Kegiatan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_draft" value="Diterima" id="ket_lampiran_draft" @if ($detailpengajuan_sidangta->ket_lampiran_draft) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_draft">
                                        Draft Laporan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_sbb_pendidikan" value="Diterima" id="ket_sbb_pendidikan" @if ($detailpengajuan_sidangta->ket_sbb_pendidikan) checked @endif>
                                    <label class="form-check-label" for="ket_sbb_pendidikan">
                                        SBB Pendidikan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_sbb_perpustakaan" value="Diterima" id="ket_sbb_perpustakaan" @if ($detailpengajuan_sidangta->ket_sbb_perpustakaan) checked @endif>
                                    <label class="form-check-label" for="ket_sbb_perpustakaan">
                                        SBB Perpustakaan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_ijazah" value="Diterima" id="ket_lampiran_ijazah" @if ($detailpengajuan_sidangta->ket_lampiran_ijazah) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_ijazah">
                                        Lampiran Ijazah SMA
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_sertifikat_pkkmb" value="Diterima" id="ket_lampiran_sertifikat_pkkmb" @if ($detailpengajuan_sidangta->ket_lampiran_sertifikat_pkkmb) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_sertifikat_pkkmb">
                                        Sertifikat PKKMB
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_lampiran_sertifikat_toefl" value="Diterima" id="ket_lampiran_sertifikat_toefl" @if ($detailpengajuan_sidangta->ket_lampiran_sertifikat_toefl) checked @endif>
                                    <label class="form-check-label" for="ket_lampiran_sertifikat_toefl">
                                        Sertifikat TOEFL
                                    </label>
                                </div>
                                
                                <div class="card shadow mb-4 m-0">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="tanggapan" id="exampleFormControlInput1" placeholder="Berikan tanggapan..." value="{{ $detailpengajuan_sidangta->tanggapan, old('tanggapan') }}">
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