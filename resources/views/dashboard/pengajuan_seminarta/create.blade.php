@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($data_ta) --}}

<div class="row">
    {{-- Form Pengajuan Seminar Tugas Akhir --}}
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Seminar Tugas Akhir</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="/dashboard/pengajuan-seminarta" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label @error('npm') is-invalid @enderror">Nomor Pokok Mahasiswa</label>
                                <input type="number" class="form-control" name="npm" id="npm" placeholder="NPM" value="{{ $data_ta->npm }}" readonly>
                            </div>
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="{{ $data_ta->nama }}" readonly>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="reguler" value="Reguler" @if($data_ta->kelas === 'Reguler') checked @endif>
                                    <label class="form-check-label " for="reguler">
                                        Reguler
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelas" id="karyawan" value="Karyawan" @if($data_ta->kelas === 'Karyawan') checked @endif>
                                    <label class="form-check-label" for="karyawan">
                                        Karyawan
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="program_studi" class="form-label">Program Studi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="informatika" value="Informatika" @if($data_ta->program_studi === 'Informatika') checked @endif>
                                    <label class="form-check-label" for="informatika">
                                        Informatika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="sistem_informasi" value="Sistem Informasi" @if($data_ta->program_studi === 'Sistem Informasi') checked @endif>
                                    <label class="form-check-label" for="sistem_informasi">
                                        Sistem Informasi
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label @error('nomor_telepon') is-invalid @enderror">Nomor Telepon</label>
                                <input type="number" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" value="{{ $data_ta->nomor_telepon, old('nomor_telepon') }}" readonly>
                            </div>
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $data_ta->email, old('email') }}" readonly>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                    </div>
                </div>
            </div>
        </div>    
    </div>

    {{-- Lampiran Berkas --}}
    <div class="col-12 col-md-12 col-lg-6">
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
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_kwitansi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_khs" class="form-label @error('foto_khs') is-invalid @enderror">Upload KHS Terakhir</label>
                                <input class="form-control" type="file" name="foto_khs" id="foto_khs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg. maks:2mb</small>
                              </div>
                            @error('foto_khs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_krs" class="form-label @error('foto_krs') is-invalid @enderror">Upload KRS Semester Berjalan</label>
                                <input class="form-control" type="file" name="foto_krs" id="foto_krs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_krs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="lembar_persetujuan_seminarta" class="form-label @error('lembar_persetujuan_seminarta') is-invalid @enderror">Lembar Persetujuan Seminar Tugas Akhir</label>
                                <input class="form-control" type="file" name="lembar_persetujuan_seminarta" id="lembar_persetujuan_seminarta">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('lembar_persetujuan_seminarta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="lembar_bimbingan1" class="form-label @error('lembar_bimbingan1') is-invalid @enderror">Lembar Bimbingan Pertama</label>
                                <input class="form-control" type="file" name="lembar_bimbingan1" id="lembar_bimbingan1">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('lembar_bimbingan1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="lembar_bimbingan2" class="form-label @error('lembar_bimbingan2') is-invalid @enderror">Lembar Bimbingan Kedua</label>
                                <input class="form-control" type="file" name="lembar_bimbingan2" id="lembar_bimbingan2">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('lembar_bimbingan2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="sertifikat_kegiatan" class="form-label @error('sertifikat_kegiatan') is-invalid @enderror">Sertifikat Kegiatan</label>
                                <input class="form-control" type="file" name="sertifikat_kegiatan[]" id="sertifikat_kegiatan" multiple>
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb, maks:5img</small>
                              </div>
                            @error('sertifikat_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="sk_ta" class="form-label @error('sk_ta') is-invalid @enderror">SK TA</label>
                                <input class="form-control" type="file" name="sk_ta" id="sk_ta">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                              </div>
                            @error('sk_ta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="" class="fw-bold">Judul Tugas Akhir Mahasiswa</label>
                            <div class="mb-3">
                                <label for="judul_smta" class="form-label @error('judul_smta') is-invalid @enderror">Judul Seminar Tugas Akhir</label>
                                <input type="text" class="form-control" name="judul_smta" id="judul_smta" placeholder="Topik Penelitian" value="{{ $data_ta->topik_penelitian, old('judul_smta') }}" readonly>
                            </div>
                            @error('judul_smta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="draft_laporan" class="form-label @error('draft_laporan') is-invalid @enderror">Draft Laporan TA</label>
                                <input class="form-control" type="file" name="draft_laporan" id="draft_laporan">
                                <small class="text-body-secondary">.pdf, maks:5mb</small>
                              </div>
                            @error('draft_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Ajukan Seminar TA</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



@endsection