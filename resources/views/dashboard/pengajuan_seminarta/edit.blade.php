@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsMahasiswa')

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuan_seminarta->no_pengajuan_seminar }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuan_seminarta->tanggal_pengajuan }}</h6>
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
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuan_seminarta->email }}</li>
                        <li class="list-group-item">Semester Ganjil - 2022/2023</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuan_seminarta->status_pengajuan_seminar === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 1)
                                <span class="badge text-bg-warning">belum diperiksa...</span>
                            @elseif ($detailpengajuan_seminarta->status_pengajuan_seminar === 3)
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
                                    @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->tanggapan)
                                    <p>
                                        {{ $detailpengajuan_seminarta->detailpengajuanseminarta[0]->tanggapan }}
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
                                        <li class="list-group-item">{{ $detailpengajuan_seminarta->judul_smta }}</li>
                                        <li class="list-group-item">
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_draft_laporan)
                                            <span class="badge text-bg-danger">
                                                Revisi
                                            </span>
                                            <p class="text-center">
                                                <strong>
                                                    Draft Laporan
                                                </strong>
                                            </p>
                                            @else
                                                
                                            <a href="{{ asset('storage/' . $detailpengajuan_seminarta->draft_laporan) }}" download>Download Draft Laporan</a>
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            @if (!$detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_sk_ta)
                                            <span class="badge text-bg-danger">
                                                Revisi
                                            </span>
                                            <p class="text-center">
                                                <strong>
                                                    SK TA
                                                </strong>
                                            </p>
                                            @else
                                            <a href="{{ asset('storage/' . $detailpengajuan_seminarta->sk_ta) }}" download>Download SK TA</a>
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
                                    <form method="post" action="/dashboard/pengajuan-seminarta/{{ $detailpengajuan_seminarta->id }}"  enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="foto_kwitansi" class="form-label">Kwitansi</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_kwitansi)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_kwitansi" id="foto_kwitansi">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                            @endif
                                        </div>
        
                                        <div class="mb-3">
                                            <label for="khs" class="form-label">KHS (Kartu Hasil Studi)</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_khs)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_khs" id="khs">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>    
                                            @endif
                                        </div>
        
                                        <div class="mb-3">
                                            <label for="krs" class="form-label">KRS (Kartu Rencana Studi)</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_krs)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_krs" id="krs">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="persetujuan_seminarta" class="form-label">Lembar Persetujuan Seminar TA</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_persetujuan_seminarta)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="foto_lembar_persetujuan_seminarta" id="persetujuan_seminarta">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="lembar_bimbingan1" class="form-label">Lembar Bimbingan 1</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_lembar_bimbingan1)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="lembar_bimbingan1" id="lembar_bimbingan1">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="lembar_bimbingan2" class="form-label">Lembar Bimbingan 2</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_lembar_bimbingan2)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="lembar_bimbingan2" id="lembar_bimbingan2">
                                            <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small> 
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="sk_ta" class="form-label">SK TA</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_sk_ta)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="sk_ta" id="sk_ta">
                                            <small class="text-body-secondary">.pdf, maks:2mb</small>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="draft_laporan" class="form-label">Draft Laporan</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_draft_laporan)
                                            <p>
                                                <strong>
                                                    Diterima
                                                </strong>
                                            </p>
                                            @else
                                            <input type="file" class="form-control" name="draft_laporan" id="draft_laporan">
                                            <small class="text-body-secondary">.pdf, maks:2mb</small>
                                            @endif
                                        </div> 
        
                                        <div class="mb-3">
                                            <label for="sertifikat_kegiatan" class="form-label">Sertifikat Kegiatan</label>
                                            @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_sertifikat_kegiatan)
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

            {{-- <div class="row flex-column flex-lg-row">

                <div class="col-12 col-lg-8 offset-lg-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Status Pemeriksaan oleh Koordinator</h6>
                        </div>
                        <div class="card-body">              
                            <form method="post" action="/dashboard/pengajuan-ta/{{ $detailpengajuan_seminarta->id }}"  enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="foto_kwitansi" class="form-label">Kwitansi</label>
                                    @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_kwitansi)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control" name="foto_kwitansi" id="foto_kwitansi">
                                    <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="ktm" class="form-label">KTM (Kartu Tanda Mahasiswa)</label>
                                    @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_ktm)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else 
                                    <input type="file" class="form-control" name="foto_ktm" id="ktm">
                                    <small class="text-body-secondary">.jped, .png, .jpg. maks:2mb</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="khs" class="form-label">KHS (Kartu Hasil Studi)</label>
                                    @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_khs)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control" name="foto_khs" id="khs">
                                    <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>    
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="krs" class="form-label">KRS (Kartu Rencana Studi)</label>
                                    @if ($detailpengajuan_seminarta->detailpengajuanseminarta[0]->ket_krs)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control" name="foto_krs" id="krs">
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
            </div> --}}
            

        </div>
    </div>

@endcan

@endsection