@extends('dashboard.layouts.main')

@section('page-heading')

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Dosen</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/dosen" >
                    @csrf
                    <div class="mb-3">
                        <label for="nidn" class="form-label @error('nidn') is-invalid @enderror">NIDN</label>
                        <input type="number" class="form-control" name="nidn" id="nidn" placeholder="NIDN" autofocus required value="{{ old('nidn') }}">
                    </div>
                    @error('nidn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required value="{{ old('nama') }}">
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="singkatan" class="form-label @error('singkatan') is-invalid @enderror">Nama Singkatan</label>
                        <input type="text" class="form-control" name="singkatan" id="singkatan" placeholder="Nama Singkatan" value="{{ old('singkatan') }}">
                    </div>
                    @error('singkatan')
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
                        <label for="kuota_pembimbing" class="form-label @error('kuota_pembimbing') is-invalid @enderror">Kuota Pembimbing</label>
                        <input type="number" class="form-control" name="kuota_pembimbing" id="kuota_pembimbing" placeholder="Kuota Pembimbing" value="{{ old('kuota_pembimbing') }}">
                    </div>
                    @error('kuota_pembimbing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="keilmuan" class="form-label @error('keilmuan') is-invalid @enderror">Keilmuan</label>
                        <input type="text" class="form-control" name="keilmuan" id="keilmuan" placeholder="Keilmuan" value="{{ old('keilmuan') }}">
                    </div>
                    @error('keilmuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection