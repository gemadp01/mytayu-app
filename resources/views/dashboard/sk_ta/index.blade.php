@extends('dashboard.layouts.main')

@section('page-heading')
    
<h1 class="h3 mb-2 text-gray-800">List SK TA</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List SK TA</h6>
    </div>

    <div class="row">
        <div class="col mb-1 mt-3 ms-3">
            <a href="/dashboard/sk-ta/create" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
                <span class="text">Tambah SK TA</span>
            </a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-body d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Tanggal Berlaku</th>
                        <th>Tanggal Berakhir</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_sk_ta as $sk_ta)
                        @php
                            $dataUser = App\Models\PengajuanTugasAkhir::where('id', $sk_ta->id)->get()->first();
                        @endphp

                        @if ($dataUser->status_pengajuan === 4)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sk_ta->npm }}</td>
                            <td>{{ $sk_ta->nama }}</td>
                            <td>{{ $sk_ta->tanggal_berlaku }}</td>
                            <td>{{ $sk_ta->tanggal_berakhir }}</td>
                            <td>
                                <a href="/dashboard/sk-ta/{{ $sk_ta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $data_sk_ta->links() }}
    </div>
</div>

@endsection