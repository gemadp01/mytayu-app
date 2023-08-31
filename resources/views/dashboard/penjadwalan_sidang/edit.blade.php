@extends('dashboard.layouts.main')

@section('page-heading')
    

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Dosen</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/penjadwalan-sidang/{{ $inputJadwal->id }}" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $inputJadwal->pengajuansidangta->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="datetime_range" class="form-label @error('datetime_range') is-invalid @enderror">Tanggal dan Waktu Seminar</label>
                        <input type="text" class="form-control" name="tanggal_penjadwalan" id="datetime_range" value="{{ old('tanggal_penjadwalan', $inputJadwal->tanggal_penjadwalan) }}">
                        @error('datetime_range')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="ruangan">Daftar Ruangan</label>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" name="ruangan" id="ruangan">
                            @foreach ($ruangan as $seminar)
                            <option value="{{ $seminar }}">{{ $seminar }}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Masukkan keterangan jika ada..." name="keterangan" id="keterangan" style="height: 100px">{{ old('keterangan', $inputJadwal->keterangan) }}</textarea>
                        <label for="keterangan">Keterangan</label>
                      </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Submit Jadwal Seminar</button>
                    </div>
                </form>
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