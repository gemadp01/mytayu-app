@extends('dashboard.layouts.main')

@section('page-heading')

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah SK TA</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/sk-ta" enctype="multipart/form-data">
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
                        <label for="tanggal_berlaku" class="form-label @error('tanggal_berlaku') is-invalid @enderror">Tanggal Berlaku</label>
                        <input type="date" class="form-control" name="tanggal_berlaku" id="tanggal_berlaku" required value="{{ old('tanggal_berlaku') }}">
                    </div>
                    @error('tanggal_berlaku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="tanggal_berakhir" class="form-label @error('tanggal_berakhir') is-invalid @enderror">Tanggal Berakhir</label>
                        <input type="date" class="form-control" name="tanggal_berakhir" id="tanggal_berakhir" required value="{{ old('tanggal_berakhir') }}">
                    </div>
                    @error('tanggal_berakhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="sk_ta" class="form-label @error('sk_ta') is-invalid @enderror">Upload File SK TA</label>
                    <input class="form-control" type="file" name="sk_ta" id="sk_ta">
                    <small class="text-body-secondary">.pdf, maks:2mb</small>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection