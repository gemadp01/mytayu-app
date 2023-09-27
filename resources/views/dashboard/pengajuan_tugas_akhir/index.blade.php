@extends('dashboard.layouts.main')

@section('page-heading')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Mahasiswa Tugas Akhir</h1>
    <h1 class="h3 mb-2 text-gray-800">
        Tahun Akademik Semester {{ $tahunAkademik->semester }} - {{ $tahunAkademik->tahun_akademik }}
    </h1>

    <div class="card shadow mb-4">
        @can('IsMahasiswa')
        {{-- @dd($tanggalBerakhirSk) --}}
        
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Skripsi/Tugas Akhir</h6>
        </div>
        <div class="card-body">
            @if (auth()->user()->pengajuantugasakhir->count() < 1)
            <div class="row">
                <div class="col mb-1">
                    <a href="/dashboard/pengajuan-ta/create" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </span>
                        <span class="text">Pengajuan Tugas Akhir</span>
                    </a>
                </div>
            </div>
            @endif
            

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
                            <th>Nomor Pengajuan</th>
                            <th>Nomor Pokok Mahasiswa</th>
                            <th>Nama</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($pengajuanta as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->nomor_pengajuan }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->tanggal_pengajuan }}</td>
                            <td class="mw-50">
                                @if ($pta->status_pengajuan === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($pta->status_pengajuan === 1)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator KP/TA...</div></span>
                                @elseif ($pta->status_pengajuan === 2)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                                @elseif ($pta->status_pengajuan === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($pta->status_pengajuan === 4)
                                    @if ($tanggalBerakhirSk !== "Belum ada SK TA")
                                        @if ($hariIni->year >= $tanggalBerakhirSk->year && $hariIni->month >= $tanggalBerakhirSk->month && $hariIni->day >= $tanggalBerakhirSk->day)
                                            <span class="badge text-bg-danger text-start">Masa berlaku SK <div>sudah berakhir.</div></span>
                                        @endif
                                    @else
                                    <span class="badge text-bg-success">Pengajuan Diterima...</span>    
                                    @endif
                                @elseif ($pta->status_pengajuan === 5)
                                    <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                                @endif

                                {{-- @if ($pta->status_pengajuan === 0)
                                    <span class="badge text-bg-danger">direvisi...</span>
                                @elseif ($pta->status_pengajuan === 1)
                                    <span class="badge text-bg-warning">diproses...</span>
                                @elseif ($pta->status_pengajuan === 4 && $pta->suratketeranganta !== null)
                                    @if ($hariIni->year >= $tanggalBerakhirSk->year && $hariIni->month >= $tanggalBerakhirSk->month && $hariIni->day >= $tanggalBerakhirSk->day)
                                        <span class="badge text-bg-danger">Masa berlaku SK sudah berakhir.</span>
                                    @else
                                    <span class="badge text-bg-success">diterima...</span>
                                    @endif
                                @elseif ($pta->status_pengajuan === 5)
                                <span class="badge text-bg-warning">Sedang diperiksa kaprodi...</span>
                                @else
                                    <span class="badge text-bg-success">diterima...</span>
                                @endif --}}
                            </td>
                            <td class="text-center">
                                @if ($pta->status_pengajuan === 1 || $pta->status_pengajuan === 2 || $pta->status_pengajuan === 3)
                                    <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @elseif ($pta->status_pengajuan === 4 && $pta->suratketeranganta !== null)

                                    @if ($tanggalBerakhirSk !== "Belum ada SK TA")
                                        @if ($hariIni->year >= $tanggalBerakhirSk->year && $hariIni->month >= $tanggalBerakhirSk->month && $hariIni->day >= $tanggalBerakhirSk->day)

                                        <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif
                                    @endif
                                
                                @elseif ($pta->status_pengajuan === 0)
                                <a href="/dashboard/pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @endif

                                @if ($pta->suratketeranganta->sk_ta !== "")
                                    <a href="{{ asset('storage/' . $pta->suratketeranganta->sk_ta) }}" class="btn btn-primary btn-circle btn-sm" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endcan

        @can('IsKoordinator')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Skripsi/Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row py-1">
                {{-- <div class="col-12 col-md-6">
                    <form action="/pengajuan-ta/import" method="POST" enctype="multipart/form-data">
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
                        <span class="text">Import data pengajuan ta</span>
                    </button>
                    </form>
                </div> --}}
                <div class="col-12 col-md-6">
                    <a href="/pengajuan-ta/export-to-pdf" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to PDF</span>
                    </a>
                    <a href="/pengajuan-ta/export-to-excel" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to Excel</span>
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
                            <th>Nomor Pengajuan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nomor Pokok Mahasiswa</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($pengajuantas as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->nomor_pengajuan }}</td>
                            <td>{{ $pta->tanggal_pengajuan }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>{{ $pta->kelas }}</td>
                            <td>{{ $pta->email }}</td>
                            <td>
                                @if ($pta->status_pengajuan === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($pta->status_pengajuan === 1)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @elseif ($pta->status_pengajuan === 2)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                                @elseif ($pta->status_pengajuan === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($pta->status_pengajuan === 4)
                                    <span class="badge text-bg-success">Pengajuan Diterima...</span>
                                @elseif ($pta->status_pengajuan === 5)
                                    <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($pta->status_pengajuan === 1)
                                <a href="/dashboard/detail-pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @else
                                    
                                    <a href="/dashboard/detail-pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- tombol delete --}}
                                {{-- <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuantas->links() }}
            </div>
        </div>
        @endcan

        @can('IsKaprodi')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data usulan Pembimbing TA</h6>
        </div>
        <div class="card-body">
            <div class="row py-1">
                <div class="col-12 col-md-6">
                    <a href="/pengajuan-ta/export-to-pdf" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to PDF</span>
                    </a>
                    <a href="/pengajuan-ta/export-to-excel" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to Excel</span>
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
                            <th rowspan="2">#</th>
                            <th rowspan="2">NPM</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Program Studi</th>
                            <th colspan="2" class="text-center">Usulan Mahasiswa</th>
                            <th colspan="2" class="text-center">Hasil Usulan Kaprodi</th>
                            <th rowspan="2">Status</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($pengajuantas as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>{{ $pta->usulanDospemPertama->nama }}</td>
                            <td>{{ $pta->usulanDospemKedua->nama }}</td>
                            <td>
                                @if ($pta->detailpengajuantugasakhir->usulanDospemKaprodiPertama === NULL)
                                    Belum diperiksa
                                @else
                                    {{ $pta->detailpengajuantugasakhir->usulanDospemKaprodiPertama->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($pta->detailpengajuantugasakhir->usulanDospemKaprodiKedua === NULL)
                                    Belum diperiksa
                                @else
                                    {{ $pta->detailpengajuantugasakhir->usulanDospemKaprodiKedua->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($pta->status_pengajuan === 0)
                                    <span class="badge text-bg-danger">revisi...</span>
                                @elseif ($pta->status_pengajuan === 1)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @elseif ($pta->status_pengajuan === 2)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                                @elseif ($pta->status_pengajuan === 3)
                                    <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                                @elseif ($pta->status_pengajuan === 4)
                                    <span class="badge text-bg-success">Pengajuan Diterima...</span>
                                @elseif ($pta->status_pengajuan === 5)
                                    <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                                @endif
                                {{-- @if ($pta->status_pengajuan === 0 || $pta->status_pengajuan === 1)
                                    <span class="badge text-bg-danger text-start">sedang diproses <div>koordinator...</div></span>
                                @elseif ($pta->status_pengajuan === 2)
                                    <span class="badge text-bg-warning">belum diperiksa...</span>
                                @elseif ($pta->status_pengajuan === 3 || $pta->status_pengajuan === 4)
                                    <span class="badge text-bg-success">telah diperiksa...</span>
                                @elseif ($pta->status_pengajuan === 5)
                                <span class="badge text-bg-danger text-start">Pengajuan ulang <div>pembimbing...</div></span>
                                @endif --}}
                            </td>
                            <td class="text-center">
                                
                                @if ($pta->status_pengajuan === 0 || $pta->status_pengajuan === 1 || $pta->status_pengajuan === 3 || $pta->status_pengajuan === 4)
                                    <a href="/dashboard/detail-pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm d-none">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="/dashboard/detail-pengajuan-ta/{{ $pta->id }}/edit" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- tombol delete --}}
                                {{-- <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuantas->links() }}
            </div>
        </div>

        @endcan

        @can('IsDekan')

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Pembimbing Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row py-1">
                <div class="col-12 col-md-6">
                    <a href="/pengajuan-ta/export-to-pdf" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to PDF</span>
                    </a>
                    <a href="/pengajuan-ta/export-to-excel" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Export to Excel</span>
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
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuantas as $pta)
                        @if ($pta->status_pengajuan === 3)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pta->npm }}</td>
                            <td>{{ $pta->nama }}</td>
                            <td>{{ $pta->program_studi }}</td>
                            <td>
                                {{ $pta->detailpengajuantugasakhir->usulanDospemKaprodiPertama->nama }}
                            </td>
                            <td>
                                {{ $pta->detailpengajuantugasakhir->usulanDospemKaprodiKedua->nama }}
                            </td>
                            <td>
                                @if ($pta->status_pengajuan === 3)
                                    <span class="badge text-bg-danger">belum disetujui...</span>
                                @endif
                            </td>
                            <td class="text-center">
                                
                                {{-- Button trigger to Approve --}}
                                <a href="/dashboard/pengajuanta/getUbah/{{ $pta->id }}" class="btn btn-success btn-circle btn-sm tampilModalUbah" data-bs-toggle="modal" data-bs-target="#modal" data-id="{{ $pta->id }}">
                                    <i class="fas fa-check"></i>
                                </a>

                                <form method="post" action="/dashboard/pengajuanta/{{ $pta->id }}/toggle-status" >
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                        
                                </form>

                                {{-- Modal --}}
                                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="formModalLabel">Approve Mahasiswa</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <form method="post" action="/dashboard/detail-pengajuan-ta/{{ $pta->id }}">
                                                @method('put')
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                                                    <input type="text" class="form-control" name="nama" id="nama" readonly>
                                                </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Approve</button>
                                        </div>
                                            </form>
                                      </div>
                                    </div>
                                </div>

                                <a href="/dashboard/pengajuan-ta/{{ $pta->id }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- tombol delete --}}
                                {{-- <form action="/dashboard/pengajuan-ta/{{ $pta->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengajuantas->links() }}
            </div>
        </div>

        @endcan
            
    </div>

@endsection

@section('only-jquery')
    <script>
        $(document).ready(function() {
            $('.tampilModalUbah').on('click', function() {
                const id = $(this).data('id');
                $('.modal-body form').attr('action', '/dashboard/detail-pengajuan-ta/' + id);

                $.ajax({
                    type: "GET",
                    url: "/dashboard/pengajuanta/getUbah/" + id,
                    // data: {id: id},
                    dataType: "json",
                    success: function (data) {
                        $('#nama').val(data.nama);
                    }
                });
            })
        })
    </script>
@endsection