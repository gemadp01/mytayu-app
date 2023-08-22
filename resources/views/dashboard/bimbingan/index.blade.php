@extends('dashboard.layouts.main')

@section('page-heading')
    
<h1 class="h3 mb-2 text-gray-800">Bimbingan Tugas Akhir dengan Dosen Pembimbing</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pembimbing 1</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        {{-- @dd(auth()->user()->pengajuantugasakhir[0]->status_pengajuan === 4) --}}
        @if (auth()->user()->pengajuantugasakhir[0]->status_pengajuan === 4)
        <dl class="row">
            <dt class="col-sm-3">NIDN</dt>
            <dd class="col-sm-9">{{ $dospemsatu->nidn }}</dd>

            <dt class="col-sm-3">Nama Pembimbing</dt>
            <dd class="col-sm-9">{{ $dospemsatu->nama }}</dd>

            <dt class="col-sm-3">Nomor Telepon</dt>
            <dd class="col-sm-9">{{ $dospemsatu->nomor_telepon }}</dd>
            <div class="row justify-content-end">
                <div class="col-8">
                    <a href="/dashboard/dospemsatu-appointment" class="btn btn-primary btn-sm">Bimbingan</a>
                </div>
            </div>
        </dl>
        @endif
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pembimbing 2</h6>
    </div>
    <div class="card-body d-flex justify-content-center">
        @if (auth()->user()->pengajuantugasakhir[0]->status_pengajuan === 4)
        <dl class="row">
            <dt class="col-sm-3">NIDN</dt>
            <dd class="col-sm-9">{{ $dospemdua->nidn }}</dd>

            <dt class="col-sm-3">Nama Pembimbing</dt>
            <dd class="col-sm-9">{{ $dospemdua->nama }}</dd>

            <dt class="col-sm-3">Nomor Telepon</dt>
            <dd class="col-sm-9">{{ $dospemdua->nomor_telepon }}</dd>
            <div class="row justify-content-end">
                <div class="col-8">
                    <a href="/dashboard/dospemdua-appointment" class="btn btn-primary btn-sm">Bimbingan</a>
                </div>
            </div>
        </dl>
        @endif
        
    </div>
</div>

@endsection