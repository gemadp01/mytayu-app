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
@endsection
