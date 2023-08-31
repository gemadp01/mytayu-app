@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($infoSidang->pengajuansidangta->detailpengajuansidangta->tanggal_penerimaan) --}}

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $infoSidang->pengajuansidangta->no_pengajuan_sidang }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $infoSidang->pengajuansidangta->tanggal_pengajuan }}</h6>
</div>
<div class="card shadow mb-4 m-0">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h6 class="font-weight-bolder text-center">Perbaikan Sidang Tugas Akhir</h6>
                <p class="text-center">Tahun Akademik 2022/2023</p>
            </div>
            <div class="col-12">
                <p>Dengan ini menyatakan bahwa pada tanggal {{ $tanggal_waktu[0] }} pukul {{ $tanggal_waktu[1] }} dengan tempat di {{ $infoSidang->ruangan }} telah dilaksanakan sidang tugas akhir untuk:</p>
            </div>
            <div class="col-12">
                <ul class="list-unstyled">
                    <li>Nama Mahasiswa : {{ $infoSidang->pengajuansidangta->nama }}</li>
                    <li>NPM : {{ $infoSidang->pengajuansidangta->npm }}</li>
                    <li>Program Studi : {{ $infoSidang->pengajuansidangta->program_studi }}</li>
                    <li>Judul Tugas Akhir : {{ $infoSidang->pengajuansidangta->judul_sdta }}</li>
                </ul>
            </div>
            <div class="col-12">
                @can('IsDospem')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->id === $dospem1->user_id && $penilaian_sidang->catatan_perbaikan_penguji_utama)
                            {!! $penilaian_sidang->catatan_perbaikan_penguji_utama !!}
                        @elseif (auth()->user()->id === $dospem2->user_id && $penilaian_sidang->catatan_perbaikan_penguji1)
                            {!! $penilaian_sidang->catatan_perbaikan_penguji1 !!}
                        @elseif (auth()->user()->id === $dospem3->user_id && $penilaian_sidang->catatan_perbaikan_penguji2)
                            {!! $penilaian_sidang->catatan_perbaikan_penguji2 !!}
                        @elseif (auth()->user()->id === $dospem4->user_id && $penilaian_sidang->catatan_perbaikan_penguji3)
                            {!! $penilaian_sidang->catatan_perbaikan_penguji3 !!}


                        @else
                        <form method="post" action="/dashboard/form-perbaikan-sidang/{{ $penilaian_sidang->id }}">
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
                @endcan
                
                @can('IsMahasiswa')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        {!! $penilaian_sidang->catatan_perbaikan_penguji_utama !!}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        {!! $penilaian_sidang->catatan_perbaikan_penguji1 !!}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        {!! $penilaian_sidang->catatan_perbaikan_penguji2 !!}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catatan Perbaikan</h6>
                    </div>
                    <div class="card-body">
                        {!! $penilaian_sidang->catatan_perbaikan_penguji3 !!}
                    </div>
                </div>
                @endcan

            </div>
        </div>
    </div>
</div>

@endsection