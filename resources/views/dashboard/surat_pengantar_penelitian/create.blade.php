@extends('dashboard.layouts.main')

@section('page-heading')

<div class="row">
    {{-- Form Pengajuan Tugas Akhir --}}
    <div class="col-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Surat Pengantar Penelitian</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="/dashboard/pengantar-penelitian" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label">Nomor Pokok Mahasiswa</label>
                                <input type="number" class="form-control @error('npm') is-invalid @enderror" name="npm" id="npm" placeholder="NPM" required readonly value="{{ auth()->user()->mahasiswa->npm, old('npm') }}">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" required readonly value="{{ auth()->user()->mahasiswa->nama, old('nama') }}">
                            </div>
                            <div class="mb-3">
                                @php
                                    $npm = auth()->user()->mahasiswa->npm;
                                    $programStudi = str_split($npm);
                                @endphp
                                <label for="program_studi" class="form-label">Program Studi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="informatika" value="Informatika" @if ($programStudi[3] == 1) checked @endif>
                                    <label class="form-check-label" for="informatika">
                                        Informatika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="sistem_informasi" value="Sistem Informasi" @if ($programStudi[3] == 2) checked @endif>
                                    <label class="form-check-label" for="sistem_informasi">
                                        Sistem Informasi
                                    </label>
                                </div>
                                @error('program_studi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="surat_dituju" class="form-label">Surat Dituju</label>
                                <input type="text" class="form-control @error('surat_dituju') is-invalid @enderror" name="surat_dituju" id="surat_dituju" placeholder="Surat Dituju" value="{{ old('surat_dituju') }}">

                                @error('surat_dituju')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" value="{{ old('nama_instansi') }}">

                                @error('nama_instansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control @error('alamat_instansi') is-invalid @enderror" placeholder="Leave a comment here" name="alamat_instansi" id="alamat_instansi" style="height: 100px" value="{{ old('alamat_instansi') }}"></textarea>
                                <label for="alamat_instansi">Alamat Instansi</label>
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
                            <label for="datetime_range" class="form-label">Tanggal dan Waktu Penelitian</label>
                            <input type="text" class="form-control @error('waktu_penelitian') is-invalid @enderror" name="waktu_penelitian" id="datetime_range" value="{{ old('waktu_penelitian') }}">
                            @error('waktu_penelitian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                            <div class="mb-3">
                                <label for="judul_penelitian" class="form-label">Judul Penelitian</label>
                                <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror" name="judul_penelitian" id="judul_penelitian" placeholder="Topik Penelitian" required value="{{ old('judul_penelitian') }}">

                                @error('judul_penelitian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="lembar_sk" class="form-label">Upload SK TA</label>
                                <input class="form-control @error('lembar_sk') is-invalid @enderror" type="file" name="lembar_sk" id="lembar_sk">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                                
                                @error('lembar_sk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@section('flatpickr')
<script>
    flatpickr("#datetime_range", {
        enableTime: true,
        dateFormat: "d-m-Y H:i",
        time_24hr: true,
    });
</script>
@endsection

@endsection