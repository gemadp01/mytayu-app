@extends('dashboard.layouts.main')

@section('page-heading')
    
<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Dosen</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/bimbingan/{{ $bimbingan_mahasiswa->id }}" >
                    @method('put')
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{ old('id') }}"> --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $bimbingan_mahasiswa->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="materi_pembahasan" class="form-label @error('materi_pembahasan') is-invalid @enderror">Materi Pembahasan</label>
                        <input type="text" class="form-control" name="materi_pembahasan" id="materi_pembahasan" value="{{ old('materi_pembahasan', $bimbingan_mahasiswa->materi_pembahasan) }}" readonly>
                        @error('materi_pembahasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="hasil_saran_tugas" class="form-label @error('hasil_saran_tugas') is-invalid @enderror">Hasil Saran Tugas</label>
                        <input type="text" class="form-control" name="hasil_saran_tugas" id="hasil_saran_tugas" placeholder="Masukkan saran dan tugas..." value="{{ old('hasil_saran_tugas', $bimbingan_mahasiswa->hasil_saran_tugas) }}">
                        @error('hasil_saran_tugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Approve bimbingan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection