@extends('dashboard.layouts.main')

@section('page-heading')

<h1 class="h3 mb-2 text-gray-800">Tahun Akademik</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tahun Akademik</h6>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 m-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-body d-flex justify-content-center">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Tahun Akademik</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $tahunAkademik->semester }}</td>
                        <td>{{ $tahunAkademik->tahun_akademik }}</td>
                        <td>
                            {{-- Button trigger to Approve --}}
                            <button type="button" class="btn btn-warning btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Modal --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Approve Mahasiswa</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <form method="post" action="/dashboard/tahun-akademik/{{ $tahunAkademik->id }}">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <label for="semester">Semester</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="semester" id="semester">
                                                    <option value="Ganjil" @if ($tahunAkademik->semester === 'Ganjil')
                                                        selected
                                                    @endif>
                                                        Ganjil
                                                    </option>
                                                    <option value="Genap" @if ($tahunAkademik->semester === 'Genap')
                                                        selected
                                                    @endif>
                                                        Genap
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="tahun_akademik">Tahun Akademik</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="tahun_akademik" id="tahun_akademik">
                                                    @php
                                                        $tahunSekarang = date('Y');
                                                        $bulanSekarang = date('n');

                                                        $tahunMulai = $bulanSekarang <= 10 ? $tahunSekarang : $tahunSekarang + 1;
                                                    @endphp
                                            
                                                    @for ($i = $tahunMulai; $i <= $tahunMulai + 1; $i++)
                                                        <option value="{{ $i - 1 }}/{{ $i }}">{{ $i - 1 }}/{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                        </form>
                                  </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection