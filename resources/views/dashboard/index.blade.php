@extends('dashboard.layouts.main')

@section('page-heading')
    <div class="d-sm-flex align-items-center mb-4">

        <img src="/img/unibi.png" alt="" width="50px">
        &nbsp;
        &nbsp;
        &nbsp;
        <h1 class="h3 mb-0 text-gray-800">
            FTI UNIBI APLIKASI PENGELOLAAN TUGAS AKHIR DAN YUDISIUM
        </h1>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            Welcome back, {{ auth()->user()->name }}, 
        </h6>
        <h6 class="h6 mb-0 text-white p-2">{{ $date }}</h6>
    </div>

    @can('IsMahasiswa')
    {{-- @dd($sk_ta->suratketeranganta->tanggal_berlaku) --}}
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                  <a href="file-dashboard/Panduan TA FTI Lengkap 2021.docx.pdf" class="text-white" download>
                    Panduan TA
                  </a>
                  <div class="text-white-50 small">Panduan TA FTI 2021</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="file-dashboard/PEDOMAN AKADEMIK.pdf" class="text-white" download>
                      Pedoman Akademik
                    </a>
                    <div class="text-white-50 small">Pedoman Akademik</div>
                  </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="file-dashboard/PEDOMAN AKADEMIK.pdf" class="text-white" download>
                      SK TA
                    </a>
                    {{-- @if ($sk_ta->sk_ta_id !== null)
                    <div class="text-white-50 small">SK TA Berlaku sampai : {{ $sk_ta->suratketeranganta->tanggal_berlaku }} </div>
                    @else
                    <div class="text-white-50 small">Tolong daftar TA terlebih dahulu.</div>  
                    @endif --}}
                  </div>
            </div>
        </div>
    </div>
    @endcan

    @can('KoordinatorKaprodiDekan')
    
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_ta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Seminar Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_seminarta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Sidang Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_sidangta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
    </div>

    @endcan

    @can('IsDospem')
    
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_ta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Seminar Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_seminarta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Sidang Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_sidangta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
    </div>

    @endcan

    @can('IsAdmin')
    
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_ta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Seminar Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_seminarta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Pengajuan Sidang Tugas Akhir
                  <div class="text-white-50 small">{{ $pengajuan_sidangta . " Mahasiswa yang sudah mendaftar" }}</div>
                </div>
            </div>
        </div>
    </div>

    @endcan
@endsection
