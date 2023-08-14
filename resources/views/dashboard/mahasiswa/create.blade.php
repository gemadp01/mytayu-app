@extends('dashboard.layouts.main')

@section('page-heading')

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Mahasiswa</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/mahasiswa" >
                    @csrf
                    <div class="mb-3">
                        <label for="npm" class="form-label @error('npm') is-invalid @enderror">NPM</label>
                        <input type="number" class="form-control" name="npm" id="npm" placeholder="NPM" autofocus required value="{{ old('npm') }}">
                    </div>
                    @error('npm')
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
                        <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
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
                        <label for="prodi" class="form-label @error('prodi') is-invalid @enderror">Prodi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prodi" id="informatika" value="Informatika">
                            <label class="form-check-label" for="reguler">
                              Informatika
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prodi" id="sistem_informasi" value="Sistem Informasi">
                            <label class="form-check-label" for="karyawan">
                              Sistem Informasi
                            </label>
                        </div>
                    </div>
                    @error('prodi')
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