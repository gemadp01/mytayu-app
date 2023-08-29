@section('page-heading')

@can('IsDospem')
<div class="card shadow mb-4 m-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
    </div>
    <div class="card-body">
        <p>Update your account's profile information</p>

        @if (session()->has('status'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger col-lg-8" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <form method="post" action="/dashboard/profile/{{ $user->id
                 }}" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nidn" class="form-label @error('nidn') is-invalid @enderror">NIDN</label>
                        <input type="number" class="form-control" name="nidn" id="nidn" placeholder="NIDN" autofocus required readonly value="{{ $user->dosen->nidn }}">
                    </div>
                    @error('nidn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required autofocus readonly value="{{ $user->dosen->nama }}">
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="singkatan" class="form-label @error('singkatan') is-invalid @enderror">Nama Singkatan</label>
                        <input type="text" class="form-control" name="singkatan" id="singkatan" placeholder="Nama Singkatan" readonly value="{{ $user->dosen->singkatan }}">
                    </div>
                    @error('singkatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->dosen->email, old('email') }}">
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label @error('nomor_telepon') is-invalid @enderror">Nomor Telepon</label>
                        <input type="number" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" value="{{ $user->dosen->nomor_telepon, old('nomor_telepon') }}">
                    </div>
                    @error('nomor_telepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="kuota_pembimbing" class="form-label @error('kuota_pembimbing') is-invalid @enderror">Kuota Pembimbing</label>
                        <input type="number" class="form-control" name="kuota_pembimbing" id="kuota_pembimbing" placeholder="Kuota Pembimbing" value="{{ $user->dosen->kuota_pembimbing, old('kuota_pembimbing') }}">
                    </div>
                    @error('kuota_pembimbing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="keilmuan" class="form-label @error('keilmuan') is-invalid @enderror">Keilmuan</label>
                        <input type="text" class="form-control" name="keilmuan" id="keilmuan" placeholder="Keilmuan" value="{{ $user->dosen->keilmuan }}" readonly>
                        <div class="row">
                            @foreach ($keilmuanDosen as $keilmuan)
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="keilmuan[]" id="{{ $loop->iteration }}" value="{{ $keilmuan }}" @if(is_array(old('keilmuan')) && in_array($keilmuan, old('keilmuan'))) checked @endif>
                                    
                                    <label class="form-check-label" for="{{ $loop->iteration }}">{{ $keilmuan }}</label>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    @error('keilmuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="current_password" class="form-label @error('current_password') is-invalid @enderror">Current Password</label>
                        <input type="password" class="form-control" name="current_password" id="current_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label @error('new_password') is-invalid @enderror">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="new_password">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endcan

@endsection