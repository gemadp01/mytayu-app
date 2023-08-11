@extends('dashboard.layouts.main')

@section('page-heading')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Dosen Terdaftar</h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    {{-- @if (session()->has('success'))
        {{ session() }}
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Dosen Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/dashboard/dosen/create" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <span class="text">Tambah dosen</span>
                    </a>
                </div>
            </div>
            <div class="row py-1">
                <div class="col">
                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </span>
                        <span class="text">Import data dosen</span>
                    </a>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Singkatan</th>
                            <th>Nomor Telepon</th>
                            <th>Kuota Pembimbing
                            <th>Keilmuan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosens as $index => $dosen)
                        <tr>
                            <td>{{ $dosens->firstItem() + $index }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->singkatan }}</td>
                            <td>{{ $dosen->nomor_telepon }}</td>
                            <td>{{ $dosen->kuota_pembimbing }}</td>
                            <td>{{ $dosen->keilmuan }}</td>
                            <td>
                                
                                @if ($dosen->status_user == 1)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                                
                                
                            </td>
                            <td class="text-center">
                                @if ($dosen->status_user === 1)
                                    <form method="post" action="/dashboard/dosen/{{ $dosen->id }}/change-status" >
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        {{-- <a href="/dashboard/dosen/{{ $dosen->id }}/edit" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> --}}
                                        
                                    </form>
                                @else
                                    <form method="post" action="/dashboard/dosen/{{ $dosen->id }}/change-status" >
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        {{-- <a href="/dashboard/dosen/{{ $dosen->id }}/edit" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> --}}
                                        
                                    </form>
                                @endif
                                

                                <a href="/dashboard/dosen/{{ $dosen->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- <a href="/dashboard/dosen/{{ $dosen->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                                <form action="/dashboard/dosen/{{ $dosen->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $dosens->links() }}
            </div>
        </div>
        
    </div>

@endsection

