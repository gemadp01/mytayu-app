@extends('dashboard.layouts.main')

@section('page-heading')
    
<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pengajuan : {{ $data_pengajuan->nomor_pengajuan }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $data_pengajuan->tanggal_pengajuan }}</h6>
</div>

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3 d-flex">
        <i class="fa fa-user pe-2" aria-hidden="true"></i>
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Surat Pengantar Penelitian</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-5 col-md-6 col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">NPM</li>
                    <li class="list-group-item">Nama</li>
                    <li class="list-group-item">Program Studi</li>
                    <li class="list-group-item">Surat Dituju</li>
                    <li class="list-group-item">Nama Instansi</li>
                    <li class="list-group-item">Alamat Instansi</li>
                    <li class="list-group-item">Waktu Penelitian</li>
                    <li class="list-group-item">Judul Penelitian</li>
                    <li class="list-group-item">Lembar SK</li>
                </ul>
            </div>
            <div class="col-7 col-md-6 col-lg-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $data_pengajuan->npm }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->nama }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->program_studi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->surat_dituju }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->nama_instansi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->alamat_instansi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->waktu_penelitian }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->judul_penelitian }}</li>
                    <li class="list-group-item">
                        <a href="{{ asset('storage/' . $data_pengajuan->lembar_sk) }}" class="btn btn-primary btn-circle btn-sm" download>
                            <i class="fa fa-download"></i>
                        </a>
                    </li>
                </ul>
                
            </div>
            {{-- <div class="col-12 col-lg-5">
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
            </div> --}}
        </div>

        <div class="row flex-column flex-lg-row">

            <div class="col-12">
                <div class="card shadow mb-4 m-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Input SK Pengantar</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">

                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form method="POST" action="/dashboard/pengantar-penelitian/{{ $data_pengajuan->id }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="yudisium" class="form-label @error('sk_pengantar') is-invalid @enderror">Upload SK Pengantar</label>
                                    <input class="form-control" type="file" name="sk_pengantar" id="sk_pengantar">
                                    <small class="text-body-secondary">.pdf, maks:2mb</small>
                                  </div>
                                @error('sk_pengantar')
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