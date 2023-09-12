@extends('dashboard.layouts.main')

@section('page-heading')

{{-- @dd($data_ta) --}}

<div class="row">
    {{-- Form Pengajuan Seminar Tugas Akhir --}}
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Sidang Tugas Akhir</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="/dashboard/pengajuan-sidangta" enctype="multipart/form-data">
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
                                <label for="foto_kwitansi_wisuda" class="form-label @error('foto_kwitansi_wisuda') is-invalid @enderror">Upload Kwitansi Pembayaran Wisuda</label>
                                <input class="form-control" type="file" name="foto_kwitansi_wisuda" id="foto_kwitansi_wisuda">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_kwitansi_wisuda')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_kwitansi_ta" class="form-label @error('foto_kwitansi_ta') is-invalid @enderror">Upload Kwitansi Pembayaran TA</label>
                                <input class="form-control" type="file" name="foto_kwitansi_ta" id="foto_kwitansi_ta">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_kwitansi_ta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="khs" class="form-label @error('khs') is-invalid @enderror">Upload KHS Terakhir</label>
                                <input class="form-control" type="file" name="khs" id="khs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg. maks:2mb</small>
                              </div>
                            @error('khs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="krs" class="form-label @error('krs') is-invalid @enderror">Upload KRS Semester Berjalan</label>
                                <input class="form-control" type="file" name="krs" id="krs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('krs')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="ktm" class="form-label @error('ktm') is-invalid @enderror">Upload KTM</label>
                                <input class="form-control" type="file" name="ktm" id="ktm">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('ktm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="sbb" class="form-label @error('sbb') is-invalid @enderror">Upload Surat Bebas Biaya</label>
                                <input class="form-control" type="file" name="sbb" id="sbb">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('sbb')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="sbb_perpustakaan" class="form-label @error('sbb_perpustakaan') is-invalid @enderror">Upload Surat Bebas Biaya Perpustakaan</label>
                                <input class="form-control" type="file" name="sbb_perpustakaan" id="sbb_perpustakaan">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('sbb_perpustakaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="lembar_persetujuan_sidang" class="form-label @error('lembar_persetujuan_sidang') is-invalid @enderror">Lembar Persetujuan Sidang Tugas Akhir</label>
                                <input class="form-control" type="file" name="lembar_persetujuan_sidang" id="lembar_persetujuan_sidang">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('lembar_persetujuan_sidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="foto_ijazah_sma" class="form-label @error('foto_ijazah_sma') is-invalid @enderror">Foto Ijazah SMA</label>
                                <input class="form-control" type="file" name="foto_ijazah_sma" id="foto_ijazah_sma">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                              </div>
                            @error('foto_ijazah_sma')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="judul_sdta" class="fw-bold">Judul Tugas Akhir Mahasiswa</label>
                            <div class="mb-3">
                                <label for="judul_sdta" class="form-label @error('judul_sdta') is-invalid @enderror">Judul Seminar Tugas Akhir</label>
                                <input type="text" class="form-control" name="judul_sdta" id="judul_sdta" placeholder="Topik Penelitian" value="{{ $data_ta->topik_penelitian, old('judul_sdta') }}" readonly>
                            </div>
                            @error('judul_sdta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="draft_laporan" class="form-label @error('draft_laporan') is-invalid @enderror">Draft Laporan TA</label>
                                <input class="form-control" type="file" name="draft_laporan" id="draft_laporan">
                                <small class="text-body-secondary">.pdf, maks:15mb</small>
                              </div>
                            @error('draft_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="sk_pembimbing" class="form-label @error('sk_pembimbing') is-invalid @enderror">Upload SK Pembimbing</label>
                                <input class="form-control" type="file" name="sk_pembimbing" id="sk_pembimbing">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                              </div>
                            @error('sk_pembimbing')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4 m-0">
                <div class="card-header py-3 d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Sertifikat</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sertifikat_pkkmb" class="form-label @error('sertifikat_pkkmb') is-invalid @enderror">Sertifikat PKKMB</label>
                        <input class="form-control" type="file" name="sertifikat_pkkmb" id="sertifikat_pkkmb">
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                      </div>
                    @error('sertifikat_pkkmb')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="sertifikat_toefl" class="form-label @error('sertifikat_toefl') is-invalid @enderror">Sertifikat TOEFL</label>
                        <input class="form-control" type="file" name="sertifikat_toefl" id="sertifikat_toefl">
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                      </div>
                    @error('sertifikat_toefl')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="sertifikat_kegiatan" class="form-label @error('sertifikat_kegiatan') is-invalid @enderror">Sertifikat Kegiatan</label>
                        <input class="form-control" type="file" name="sertifikat_kegiatan[]" id="sertifikat_kegiatan" multiple>
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb, maks:10files</small>
                      </div>
                    @error('sertifikat_kegiatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Ajukan Sidang TA</button>
                    </div>
                </form>
                </div>
            </div>
    </div>
</div>



@endsection