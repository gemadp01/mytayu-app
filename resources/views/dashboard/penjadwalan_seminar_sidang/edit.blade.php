@extends('dashboard.layouts.main')

@section('page-heading')
    
<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Dosen</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/penjadwalan-seminar-sidang/{{ $inputJadwal->id }}" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $inputJadwal->pengajuansta->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="datetime_range" class="form-label @error('datetime_range') is-invalid @enderror">Tanggal dan Waktu Seminar</label>
                        <input type="text" class="form-control" name="datetime_range" id="datetime_range" value="{{ old('datetime_range', $inputJadwal->tanggal_penjadwalan . ' ' . $inputJadwal->waktu_seminar) }}">
                        @error('datetime_range')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruangan" class="form-label @error('ruangan') is-invalid @enderror">Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" id="ruangan" value="{{ old('ruangan', $inputJadwal->ruangan) }}">
                        @error('ruangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Submit Jadwal Seminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection