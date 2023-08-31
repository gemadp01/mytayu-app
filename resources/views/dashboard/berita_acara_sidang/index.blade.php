@extends('dashboard.layouts.main')

@section('page-heading')

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
                <h6 class="font-weight-bolder text-center">BERITA ACARA SIDANG TUGAS AKHIR</h6>
                <p class="text-center">Tahun Akademik 2022/2023</p>
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
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Penilaian</h6>
                            </div>
                            <div class="card-body d-flex justify-content-evenly">
        
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Huruf Mutu</th>
                                            <th>Nilai Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-success">A</span>
                                            </td>
                                            <td>>80</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-success">AB</span>
                                            </td>
                                            <td>70< N <=80</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-primary">B</span>
                                            </td>
                                            <td>>65< N <=70</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-primary">BC</span>
                                            </td>
                                            <td>>60< N <=65</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-warning">C</span>
                                            </td>
                                            <td>>50< N <=60</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-warning">D</span>
                                            </td>
                                            <td>>40< N <=50</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge text-bg-danger">E</span>
                                            </td>
                                            <td><=40</td>
                                        </tr>
                                    </tbody>
                                </table>
        
                            </div>
                        </div>
                    </div>
    
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">List Dosen Penguji</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dosen Penguji</th>
                                            <th>Status Pengujian</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                {{ $dospem1->nama }}
                                            </td>
                                            <td>
                                                @if ($penilaian_sidang->approve_penguji_utama)
                                                <span class="badge text-bg-success">[tertanda]</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($penilaian_sidang->nilai_penguji_utama))
                                                    {{ $penilaian_sidang->nilai_penguji_utama }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>
                                                {{ $dospem2->nama }}
                                            </td>
                                            <td>
                                                @if ($penilaian_sidang->approve_penguji1)
                                                <span class="badge text-bg-success">[tertanda]</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($penilaian_sidang->nilai_penguji1))
                                                    {{ $penilaian_sidang->nilai_penguji1 }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>
                                                {{ $dospem3->nama }}
                                            </td>
                                            <td>
                                                @if ($penilaian_sidang->approve_penguji2)
                                                <span class="badge text-bg-success">[tertanda]</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($penilaian_sidang->nilai_penguji2))
                                                    {{ $penilaian_sidang->nilai_penguji2 }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>
                                                {{ $dospem4->nama }}
                                            </td>
                                            <td>
                                                @if ($penilaian_sidang->approve_penguji3)
                                                <span class="badge text-bg-success">[tertanda]</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($penilaian_sidang->nilai_penguji3))
                                                    {{ $penilaian_sidang->nilai_penguji3 }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td rowspan="2" colspan="2">Rata-rata Nilai</td>
                                            <td>Nilai Akhir</td>
                                            <td>{{ $hasil_penilaian }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Mutu</td>
                                            <td>
                                                @if ($hasil_penilaian > 80)
                                                    A
                                                @elseif ($hasil_penilaian <= 80 && $hasil_penilaian >= 70)
                                                    AB
                                                @elseif ($hasil_penilaian <= 70 && $hasil_penilaian > 65)
                                                    B
                                                @elseif ($hasil_penilaian <= 65 && $hasil_penilaian > 60)
                                                    BC
                                                @elseif ($hasil_penilaian <= 60 && $hasil_penilaian > 50)
                                                    C
                                                @elseif ($hasil_penilaian <= 50 && $hasil_penilaian > 40)
                                                    D
                                                @elseif ($hasil_penilaian <= 40)
                                                    E
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @can('IsDospem')
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 offset-md-6">
                        <div class="card shadow mb-4 m-0">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="/dashboard/penilaian-sidang/{{ $infoSidang->id }}">
                                    @method('put')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="input_nilai" class="form-label">Input Nilai</label>
                                        <input type="number" class="form-control" name="input_nilai" id="input_nilai" placeholder="Masukkan Nilai...">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endcan
        
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection