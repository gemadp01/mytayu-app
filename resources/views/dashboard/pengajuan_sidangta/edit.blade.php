@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsMahasiswa')

{{-- @dd($detailpengajuan_sidangta) --}}

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuan_sidangta->no_pengajuan_sidang }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_sidangta->tanggal_pengajuan }}</h6>
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
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_sidangta->email }}</li>
                        <li class="list-group-item">Semester Ganjil - 2022/2023</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuan_sidangta->status_pengajuan_sidang === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuan_sidangta->status_pengajuan_sidang === 1)
                                <span class="badge text-bg-warning">belum diperiksa...</span>
                            @elseif ($detailpengajuan_sidangta->status_pengajuan_sidang === 2)
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
                                    @if ($detailpengajuan_sidangta->detailpengajuansidangta->tanggapan)
                                    <p>
                                        {{ $detailpengajuan_sidangta->detailpengajuansidangta->tanggapan }}
                                    </p>
                                    @elseif ($detailpengajuan_sidangta->detailpengajuansidangta->tanggapan === null)
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
                                        <li class="list-group-item">{{ $detailpengajuan_sidangta->judul_sdta }}</li>
                                        <li class="list-group-item">
                                            @if (!$detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_draft)
                                            <span class="badge text-bg-danger">
                                                Revisi
                                            </span>
                                            <p class="text-center">
                                                <strong>
                                                    Draft Laporan
                                                </strong>
                                            </p>
                                            @else
                                                
                                            <a href="{{ asset('storage/' . $detailpengajuan_sidangta->draft_laporan) }}" download>Download Draft Laporan</a>
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            @if (!$detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_sk_pembimbing)
                                            <span class="badge text-bg-danger">
                                                Revisi
                                            </span>
                                            <p class="text-center">
                                                <strong>
                                                    SK TA
                                                </strong>
                                            </p>
                                            @else
                                            <a href="{{ asset('storage/' . $detailpengajuan_sidangta->sk_pembimbing) }}" download>Download SK Pembimbing</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Status Pemeriksaan oleh Koordinator</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form method="post" action="/dashboard/pengajuan-sidangta/{{ $detailpengajuan_sidangta->id }}" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="foto_kwitansi_wisuda" class="form-label">Kwitansi Wisuda</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_kwitansi_wisuda)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_kwitansi_wisuda" id="foto_kwitansi_wisuda">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="foto_kwitansi_ta" class="form-label">Kwitansi TA</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_kwitansi_ta)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_kwitansi_ta" id="foto_kwitansi_ta">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                            @endif
                                        </div>
        
                                        <div class="mb-3">
                                            <label for="khs" class="form-label">KHS (Kartu Hasil Studi)</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_khs)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="khs" id="khs">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>    
                                            @endif
                                        </div>
        
                                        <div class="mb-3">
                                            <label for="krs" class="form-label">KRS (Kartu Rencana Studi)</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_krs)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="krs" id="krs">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="ktm" class="form-label">KTM (Kartu Tanda Mahasiswa)</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_ktm)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="ktm" id="ktm">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="sbb" class="form-label">SBB Pendidikan</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_sbb_pendidikan)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sbb" id="sbb">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="sbb_perpustakaan" class="form-label">SBB Perpustakaan</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_sbb_perpustakaan)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sbb_perpustakaan" id="sbb_perpustakaan">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="persetujuan_sidangta" class="form-label">Lembar Persetujuan sidang TA</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_persetujuan_sidang)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="lembar_persetujuan_sidang" id="persetujuan_sidangta">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="sk_pembimbing" class="form-label">SK Pembimbing</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_sk_pembimbing)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sk_pembimbing" id="sk_pembimbing">
                                            <small class="text-body-secondary">.pdf, maks:2mb</small>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="draft_laporan" class="form-label">Draft Laporan</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_draft)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="draft_laporan" id="draft_laporan">
                                            <small class="text-body-secondary">.pdf, maks:15mb</small>
                                            @endif
                                        </div> 
        
                                        <div class="mb-3">
                                            <label for="sertifikat_kegiatan" class="form-label">Sertifikat Kegiatan</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_sertifikat_kegiatan)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sertifikat_kegiatan[]" id="sertifikat_kegiatan" multiple>
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="sertifikat_pkkmb" class="form-label">Sertifikat PKKMB</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_sertifikat_pkkmb)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sertifikat_pkkmb" id="sertifikat_pkkmb">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="sertifikat_toefl" class="form-label">Sertifikat TOEFL</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_sertifikat_toefl)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sertifikat_toefl" id="sertifikat_toefl">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="foto_ijazah_sma" class="form-label">Foto Ijazah SMA</label>
                                            @if ($detailpengajuan_sidangta->detailpengajuansidangta->ket_lampiran_ijazah)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_ijazah_sma" id="foto_ijazah_sma">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Ajukan Revisi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endcan

@endsection