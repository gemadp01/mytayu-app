@extends('dashboard.layouts.main')

@section('page-heading')
    
@can('IsMahasiswa')

{{-- @dd($detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiPertama) --}}

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
                            @endif
                        </li>
                        <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". ($detailpengajuanta->usulanDospemPertama->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->usulanDospemPertama->nama ?? 'Default nama') }}</li>
                        <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". ($detailpengajuanta->usulanDospemKedua->singkatan ?? 'Default Singkatan') ." ) " . ($detailpengajuanta->usulanDospemKedua->nama ?? 'Default nama') }}</li>
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
                                    <div class="card h-auto">
                                        <img src="{{ asset('storage/' . $detailpengajuanta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                            <span class="badge text-bg-success">
                                                Diterima
                                            </span>
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
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_kwitansi)
                                            <span class="badge text-bg-danger">
                                                    Revisi Kwitansi
                                                </span>
                                            @endif
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
                                            <span class="badge text-bg-success">
                                                diterima
                                            </span>
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
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_ktm)
                                            <span class="badge text-bg-danger">
                                                Revisi KTM
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="col-12 col-sm-5 col-md-3 col-md-5 col-xl-2">
                                    @if($detailpengajuanta->foto_khs)
                                    <div class="card h-auto" style="width: 10rem;">
                                        <img src="{{ asset('storage/' . $detailpengajuanta->foto_khs) }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->foto_khs) }}" download>Download KHS</a>
                                            <span class="badge text-bg-success">
                                                diterima
                                            </span>
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
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_khs)
                                            <span class="badge text-bg-danger">
                                                Revisi KHS
                                            </span>
                                            @endif
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
                                            <span class="badge text-bg-success">
                                                diterima
                                            </span>
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
                                            @if (!$detailpengajuanta->detailpengajuantugasakhir->ket_krs)
                                            <span class="badge text-bg-danger">
                                                Revisi KRS
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>      
                </div>
            </div>

            <div class="row flex-column flex-lg-row">

                <div class="col-12 col-lg-8 offset-lg-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Status Pemeriksaan oleh Koordinator</h6>
                        </div>
                        <div class="card-body">              
                            <form method="post" action="/dashboard/pengajuan-ta/{{ $detailpengajuanta->id }}"  enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="foto_kwitansi" class="form-label">Kwitansi</label>
                                    @if ($detailpengajuanta->detailpengajuantugasakhir->ket_kwitansi)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control @error('foto_kwitansi') is-invalid @enderror" name="foto_kwitansi" id="foto_kwitansi">
                                    <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>

                                    @error('foto_kwitansi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="ktm" class="form-label">KTM (Kartu Tanda Mahasiswa)</label>
                                    @if ($detailpengajuanta->detailpengajuantugasakhir->ket_ktm)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else 
                                    <input type="file" class="form-control @error('foto_ktm') is-invalid @enderror" name="foto_ktm" id="ktm">
                                    <small class="text-body-secondary">.jped, .png, .jpg. maks:2mb</small>

                                    @error('foto_ktm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="khs" class="form-label">KHS (Kartu Hasil Studi)</label>
                                    @if ($detailpengajuanta->detailpengajuantugasakhir->ket_khs)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control @error('foto_khs') is-invalid @enderror" name="foto_khs" id="khs">
                                    <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                    
                                    @error('foto_khs')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="krs" class="form-label">KRS (Kartu Rencana Studi)</label>
                                    @if ($detailpengajuanta->detailpengajuantugasakhir->ket_krs)
                                    <p>
                                        <strong>
                                            Diterima
                                        </strong>
                                    </p>
                                    @else
                                    <input type="file" class="form-control @error('foto_krs') is-invalid @enderror" name="foto_krs" id="krs">
                                    <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                                    
                                    @error('foto_krs')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                                </div>
                                
                                @if ($detailpengajuanta->status_pengajuan === 0)
                                    
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Ajukan Revisi</button>
                                </div>
                            </form>
                                @endif
                        </div>
                    </div>      
                </div>

                @if ($detailpengajuanta->suratketeranganta !== null)
                <div class="col-12 col-lg-8 offset-lg-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Ulang Tugas Akhir</h6>
                        </div>
                        <div class="card-body">              
                            {{-- <form method="post" action="/dashboard/pengajuan-ta/{{ $detailpengajuanta->id }}"  enctype="multipart/form-data">
                                @method('put')
                                @csrf --}}
                                

                                <div>
                                    <label for="pembimbing_satu">Pembimbing 1</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="usulan_pembimbing_mhs1_id" id="pembimbing_satu">
                                      <option value="{{ $detailpengajuanta->detailpengajuantugasakhir->usulan_pembimbing_kaprodi1_id }}" selected>
                                        {{ $detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiPertama->nama }}
                                      </option>
                                      @foreach ($dospems as $dospem)
                                      
                                        <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama --- $dospem->keilmuan --- Kuota[$dospem->kuota_pembimbing]" }}</option>
                                        {{-- @if ($dospem->kuota)
                                            
                                        @endif --}}
                                      @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="pembimbing_dua">Pembimbing 2</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="usulan_pembimbing_mhs2_id" id="pembimbing_dua">
                                        <option value="{{ $detailpengajuanta->detailpengajuantugasakhir->usulan_pembimbing_kaprodi2_id }}" selected>
                                            {{ $detailpengajuanta->detailpengajuantugasakhir->usulanDospemKaprodiKedua->nama }}
                                          </option>
                                      @foreach ($dospems as $dospem)
                                        <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama --- $dospem->keilmuan --- Kuota[$dospem->kuota_pembimbing]" }}</option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Ajukan Revisi</button>
                                </div>
                            </form>
                        </div>
                    </div>      
                </div>
                @endif
            </div>
            

        </div>
    </div>

@endcan

@endsection