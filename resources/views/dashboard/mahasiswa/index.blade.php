@extends('dashboard.layouts.main')

@section('page-heading')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Mahasiswa Terdaftar</h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.</p> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/dashboard/mahasiswa/create" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <span class="text">Tambah mahasiswa</span>
                    </a>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-12 col-md-6">
                    <form action="/mahasiswa/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            @error('excel_file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="file" name="excel_file" class="form-control">
                            <small class="text-body-secondary">.xlsx(excel)</small>
                        </div>

                </div>
                <div class="col-12 col-md-6 mt-1">
                    <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </span>
                        <span class="text">Import data mahasiswa</span>
                    </button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <a href="/mahasiswa/export-to-pdf" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to PDF</span>
                    </a>
                    <a href="/mahasiswa/export-to-excel" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to Excel</span>
                    </a>
                </div>

                <div class="col-6 d-flex justify-content-end">
                    <form action="">
                        <input type="text" class="form-control" name="keyword" id="keyword" size="40" placeholder="Masukkan Keyword Pencarian..." autofocus autocomplete="off">
                        <button type="submit" class="btn btn-primary" name="cari" id="tombol-cari">Cari!</button>
                    </form>
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
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Prodi</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswas->firstItem() + $index }}</td>
                            <td>{{ $mahasiswa->npm }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->kelas }}</td>
                            <td>{{ $mahasiswa->prodi }}</td>
                            <td>
                                
                                @if ($mahasiswa->status_user == 1)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                                
                                
                            </td>
                            <td class="text-center">
                                <form method="post" action="/dashboard/mahasiswa/{{ $mahasiswa->id }}/toggle-status" >
                                @csrf
                                    @if ($mahasiswa->status_user === 1)
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                </form>
                                

                                <a href="/dashboard/mahasiswa/{{ $mahasiswa->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- <a href="/dashboard/mahasiswa/{{ $mahasiswa->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                                <form action="/dashboard/mahasiswa/{{ $mahasiswa->id }}" method="POST" class="d-inline">
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
                {{ $mahasiswas->links() }}
            </div>
        </div>
    </div>
    

@endsection

@section('only-jquery')

<script>
    $(document).ready(function() {
        $('#tombol-cari').hide();

        $('#keyword').keyup(function() {
            var keyword = $(this).val();

            $.ajax({
                url: '/pencarian-mahasiswa',
                method: 'GET',
                data: { keyword: keyword },
                success: function(response) {
                    var tbody = $('#dataTable tbody');
                    tbody.empty();

                    $.each(response.mahasiswas, function(index, mahasiswa) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + mahasiswa.npm + '</td>' +
                            '<td>' + mahasiswa.nama + '</td>' +
                            '<td>' + mahasiswa.kelas + '</td>' +
                            '<td>' + mahasiswa.prodi + '</td>' +
                            '<td>' + (mahasiswa.status_user == 1 ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-secondary">Inactive</span>') + '</td>' +
                            '<td class="text-center">' +
                                '<form method="post" action="/dashboard/mahasiswa/' + mahasiswa.id + '/toggle-status">' +
                                    '@csrf' +
                                    (mahasiswa.status_user === 1 ?
                                        '<button type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-times"></i></button>' :
                                        '<button type="submit" class="btn btn-success btn-circle btn-sm"><i class="fas fa-check"></i></button>'
                                    ) +
                                '</form>' +

                                '<a href="/dashboard/mahasiswa/' + mahasiswa.id + ' /edit" class="btn btn-warning btn-circle btn-sm">'
                                    + '<i class="fas fa-edit"></i>' +
                                '</a>'
                            '</td>'
                                
                            '</tr>';

                        tbody.append(row);
                    });
                }
            });
        });
    });
</script>
    
@endsection

