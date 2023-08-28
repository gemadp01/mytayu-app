@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($penilaian_seminar) --}}

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $infoSeminar->pengajuansta->no_pengajuan_seminar }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $infoSeminar->pengajuansta->tanggal_pengajuan }}</h6>
</div>
<div class="card shadow mb-4 m-0">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h6 class="font-weight-bolder text-center">Perbaikan Seminar Tugas Akhir</h6>
                <p class="text-center">Tahun Akademik 2022/2023</p>
            </div>
            <div class="col-12">
                <p>Dengan ini menyatakan bahwa pada tanggal {{ $infoSeminar->tanggal_approve_seminarta }} pukul {{ $tanggal_waktu[1] }} dengan tempat di {{ $infoSeminar->ruangan }} telah dilaksanakan seminar tugas akhir untuk:</p>
            </div>
            <div class="col-12">
                <ul class="list-unstyled">
                    <li>Nama Mahasiswa : {{ $infoSeminar->pengajuansta->nama }}</li>
                    <li>NPM : {{ $infoSeminar->pengajuansta->npm }}</li>
                    <li>Program Studi : {{ $infoSeminar->pengajuansta->program_studi }}</li>
                    <li>Judul Tugas Akhir : {{ $infoSeminar->pengajuansta->judul_smta }}</li>
                </ul>
            </div>
            <div class="col-12">
                <!-- Page Heading -->
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->id === $dospem1->user_id && $penilaian_seminar->catatan_perbaikan_pembimbing1)
                            {!! $penilaian_seminar->catatan_perbaikan_pembimbing1 !!}
                        @elseif (auth()->user()->id === $dospem2->user_id && $penilaian_seminar->catatan_perbaikan_pembimbing2)
                            {!! $penilaian_seminar->catatan_perbaikan_pembimbing2 !!}
                        @else
                        <form method="post" action="/dashboard/form-perbaikan/{{ $penilaian_seminar->id }}">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                {{-- <label for="formPerbaikan" class="form-label">Form Perbaikan</label> --}}
                                @error('formPerbaikan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="formPerbaikan" type="hidden" name="formPerbaikan" value="{{ old('formPerbaikan') }}">
                                <trix-editor input="formPerbaikan"></trix-editor> 
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection