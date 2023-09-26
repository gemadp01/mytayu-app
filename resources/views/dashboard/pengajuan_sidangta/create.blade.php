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
                                <label for="npm" class="form-label">Nomor Pokok Mahasiswa</label>
                                <input type="number" class="form-control @error('npm') is-invalid @enderror" name="npm" id="npm" placeholder="NPM" value="{{ $data_ta->npm }}" readonly>
                                @error('npm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" value="{{ $data_ta->nama }}" readonly>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" value="{{ $data_ta->nomor_telepon, old('nomor_telepon') }}" readonly>
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $data_ta->email, old('email') }}" readonly>
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
                                <label for="foto_kwitansi_wisuda" class="form-label">Upload Kwitansi Pembayaran Wisuda</label>
                                <input class="form-control @error('foto_kwitansi_wisuda') is-invalid @enderror" type="file" name="foto_kwitansi_wisuda" id="foto_kwitansi_wisuda">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('foto_kwitansi_wisuda')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_kwitansi_ta" class="form-label">Upload Kwitansi Pembayaran TA</label>
                                <input class="form-control @error('foto_kwitansi_ta') is-invalid @enderror" type="file" name="foto_kwitansi_ta" id="foto_kwitansi_ta">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('foto_kwitansi_ta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="khs" class="form-label">Upload KHS Terakhir</label>
                                <input class="form-control @error('khs') is-invalid @enderror" type="file" name="khs" id="khs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg. maks:2mb</small>
                                @error('khs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="krs" class="form-label">Upload KRS Semester Berjalan</label>
                                <input class="form-control @error('krs') is-invalid @enderror" type="file" name="krs" id="krs">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('krs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ktm" class="form-label">Upload KTM</label>
                                <input class="form-control @error('ktm') is-invalid @enderror" type="file" name="ktm" id="ktm">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('ktm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sbb" class="form-label">Upload Surat Bebas Biaya</label>
                                <input class="form-control @error('sbb') is-invalid @enderror" type="file" name="sbb" id="sbb">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('sbb')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sbb_perpustakaan" class="form-label">Upload Surat Bebas Biaya Perpustakaan</label>
                                <input class="form-control @error('sbb_perpustakaan') is-invalid @enderror" type="file" name="sbb_perpustakaan" id="sbb_perpustakaan">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('sbb_perpustakaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lembar_persetujuan_sidang" class="form-label">Lembar Persetujuan Sidang Tugas Akhir</label>
                                <input class="form-control @error('lembar_persetujuan_sidang') is-invalid @enderror" type="file" name="lembar_persetujuan_sidang" id="lembar_persetujuan_sidang">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('lembar_persetujuan_sidang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_ijazah_sma" class="form-label">Foto Ijazah SMA</label>
                                <input class="form-control @error('foto_ijazah_sma') is-invalid @enderror" type="file" name="foto_ijazah_sma" id="foto_ijazah_sma">
                                <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                                @error('foto_ijazah_sma')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label for="judul_sdta" class="fw-bold">Judul Tugas Akhir Mahasiswa</label>
                            <div class="mb-3">
                                <label for="judul_sdta" class="form-label">Judul Seminar Tugas Akhir</label>
                                <input type="text" class="form-control @error('judul_sdta') is-invalid @enderror" name="judul_sdta" id="judul_sdta" placeholder="Topik Penelitian" value="{{ $data_ta->topik_penelitian, old('judul_sdta') }}" readonly>
                                @error('judul_sdta')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="draft_laporan" class="form-label">Draft Laporan TA</label>
                                <input class="form-control @error('draft_laporan') is-invalid @enderror" type="file" name="draft_laporan" id="draft_laporan">
                                <small class="text-body-secondary">.pdf, maks:15mb</small>
                                @error('draft_laporan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sk_pembimbing" class="form-label">Upload SK Pembimbing</label>
                                <input class="form-control @error('sk_pembimbing') is-invalid @enderror" type="file" name="sk_pembimbing" id="sk_pembimbing">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                                @error('sk_pembimbing')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                        <label for="sertifikat_pkkmb" class="form-label">Sertifikat PKKMB</label>
                        <input class="form-control @error('sertifikat_pkkmb') is-invalid @enderror" type="file" name="sertifikat_pkkmb" id="sertifikat_pkkmb">
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                        @error('sertifikat_pkkmb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sertifikat_toefl" class="form-label">Sertifikat TOEFL</label>
                        <input class="form-control @error('sertifikat_toefl') is-invalid @enderror" type="file" name="sertifikat_toefl" id="sertifikat_toefl">
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb</small>
                        @error('sertifikat_toefl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sertifikat_kegiatan" class="form-label">Sertifikat Kegiatan</label>
                        <input class="form-control @error('sertifikat_kegiatan') is-invalid @enderror" type="file" name="sertifikat_kegiatan[]" id="sertifikat_kegiatan" multiple>
                        <small class="text-body-secondary">.jpeg, .png, .jpg, maks:2mb, maks:10files</small>
                        @error('sertifikat_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Ajukan Sidang TA</button>
                    </div>
                </form>
                </div>
            </div>
    </div>
</div>



@endsection