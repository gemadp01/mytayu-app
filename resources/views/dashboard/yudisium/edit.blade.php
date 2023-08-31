@extends('dashboard.layouts.main')

@section('page-heading')
    
<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $data_pengajuan->pengajuansidangta->no_pengajuan_sidang }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $data_pengajuan->pengajuansidangta->tanggal_pengajuan }}</h6>
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
                    <li class="list-group-item">Judul Penelitian Tugas Akhir</li>
                </ul>
            </div>
            <div class="col-7 col-md-6 col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->npm }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nama }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->program_studi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->kelas }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nomor_telepon }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->email }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->judul_sdta }}</li>
                </ul>
                
            </div>
            <div class="col-12 col-lg-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Pengajuan : 
                        @if ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
                        @else
                            <span class="badge text-bg-success">diterima...</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="row flex-column flex-lg-row">

            <div class="col-12">
                <div class="card shadow mb-4 m-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Input File Yudisium</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <label for="pembimbing1_id">Dosen Pembimbing 1</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="pembimbing1_id" id="pembimbing1_id" disabled>
                                        <option value="{{ $data_pengajuan->pembimbing1_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing1_id)->pluck('nama')->first() }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div>
                                    <label for="pembimbing1_id">Dosen Pembimbing 2</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="pembimbing2_id" id="pembimbing2_id" disabled>
                                        <option value="{{ $data_pengajuan->pembimbing2_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing2_id)->pluck('nama')->first() }}</option>
                                    </select>
                                </div>
                            </div>

                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form method="POST" action="/yudisium/{{ $data_pengajuan->id }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="yudisium" class="form-label @error('yudisium') is-invalid @enderror">Upload File Yudisium</label>
                                    @if (!empty($data_pengajuan->pengajuansidangta->yudisium))
                                    <button type="submit" class="btn btn-success btn-circle btn-sm" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif
                                    <input class="form-control" type="file" name="yudisium" id="yudisium">
                                    <small class="text-body-secondary">.pdf, maks:2mb</small>
                                  </div>
                                @error('yudisium')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Upload Yudisium</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>      
            </div>
        </div>

        

    </div>
</div>

@endsection