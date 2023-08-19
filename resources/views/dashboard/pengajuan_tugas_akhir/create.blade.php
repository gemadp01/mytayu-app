@extends('dashboard.layouts.main')

@section('page-heading')


<div class="row">
    {{-- Form Pengajuan Tugas Akhir --}}
    <div class="col-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Tugas Akhir</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="/dashboard/pengajuan-ta" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label @error('npm') is-invalid @enderror">Nomor Pokok Mahasiswa</label>
                                <input type="number" class="form-control" name="npm" id="npm" placeholder="NPM" autofocus required value="{{ $mahasiswa[0]->npm, old('npm') }}">
                            </div>
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required value="{{ $mahasiswa[0]->nama, old('nama') }}">
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="kelas" class="form-label @error('kelas') is-invalid @enderror">Kelas</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="reguler" value="Reguler">
                                    <label class="form-check-label " for="reguler">
                                        Reguler
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="karyawan" value="Karyawan">
                                    <label class="form-check-label" for="karyawan">
                                        Karyawan
                                    </label>
                                </div>
                            </div>
                            @error('kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label for="program_studi" class="form-label @error('program_studi') is-invalid @enderror">Program Studi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="informatika" value="Informatika">
                                    <label class="form-check-label" for="informatika">
                                        Informatika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="sistem_informasi" value="Sistem Informasi">
                                    <label class="form-check-label" for="sistem_informasi">
                                        Sistem Informasi
                                    </label>
                                </div>
                            </div>
                            @error('program_studi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label @error('nomor_telepon') is-invalid @enderror">Nomor Telepon</label>
                                <input type="number" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}">
                            </div>
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="" class="fw-bold">Usulan Pembimbing</label>
                            <div>
                                <label for="pembimbing_satu">Pembimbing 1</label>
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-select" name="usulan_pembimbing_mhs1_id" id="pembimbing_satu">
                                  <option selected>Choose...</option>
                                  @foreach ($dospems as $dospem)
                                    <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama" }}</option>
                                  @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="pembimbing_dua">Pembimbing 2</label>
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-select" name="usulan_pembimbing_mhs2_id" id="pembimbing_dua">
                                  <option selected>Choose...</option>
                                  @foreach ($dospems as $dospem)
                                    <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama" }}</option>
                                  @endforeach
                                </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    {{-- Lampiran Berkas --}}
    <div class="col-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lampiran Berkas</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                            <div class="mb-3">
                                <label for="foto_kwitansi" class="form-label @error('foto_kwitansi') is-invalid @enderror">Upload Kwitansi Pembayaran TA</label>
                                <input class="form-control" type="file" name="foto_kwitansi" id="foto_kwitansi">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_kwitansi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_khs" class="form-label @error('foto_khs') is-invalid @enderror">Upload KHS Terakhir</label>
                                <input class="form-control" type="file" name="foto_khs" id="foto_khs">
                                <small class="text-body-secondary">.jped, .png, .jpg. maks:2mb</small>
                              </div>
                            @error('foto_khs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_krs" class="form-label @error('foto_krs') is-invalid @enderror">Upload KRS Semester Berjalan</label>
                                <input class="form-control" type="file" name="foto_krs" id="foto_krs">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_krs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_ktm" class="form-label @error('foto_ktm') is-invalid @enderror">Upload KTM</label>
                                <input class="form-control" type="file" name="foto_ktm" id="foto_ktm">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_ktm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="" class="fw-bold">Outline Proposal TA/Skripsi</label>
                            <div class="mb-3">
                                <label for="topik_penelitian" class="form-label @error('topik_penelitian') is-invalid @enderror">Topik Penelitian</label>
                                <input type="text" class="form-control" name="topik_penelitian" id="topik_penelitian" placeholder="Topik Penelitian" required value="{{ old('topik_penelitian') }}">
                            </div>
                            @error('topik_penelitian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="proposal_ta" class="form-label @error('proposal_ta') is-invalid @enderror">Upload Outline Proposal TA/Skripsi</label>
                                <input class="form-control" type="file" name="proposal_ta" id="proposal_ta">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                              </div>
                            @error('proposal_ta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



@endsection