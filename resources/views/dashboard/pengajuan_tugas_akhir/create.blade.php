@extends('dashboard.layouts.main')

@section('page-heading')

<div class="row">
    {{-- Form Pengajuan Tugas Akhir --}}
    <div class="col-6">
        <div class="card shadow mb-4 m-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Tugas Akhir</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="/dashboard/pengajuan-ta" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label @error('npm') is-invalid @enderror">Nomor Pokok Mahasiswa</label>
                                <input type="number" class="form-control" name="npm" id="npm" placeholder="NPM" required readonly value="{{ $mahasiswa[0]->npm, old('npm') }}">
                            </div>
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nama" class="form-label @error('nama') is-invalid @enderror">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required readonly value="{{ $mahasiswa[0]->nama, old('nama') }}">
                            </div>
                            @error('nama')
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
                                <label for="program_studi" class="form-label @error('program_studi') is-invalid @enderror">Program Studi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="informatika" value="Informatika">
                                    <label class="form-check-label" for="informatika">
                                        Informatika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="program_studi" id="sistem_informasi" value="Sistem Informasi">
                                    <label class="form-check-label" for="sistem_informasi">
                                        Sistem Informasi
                                    </label>
                                </div>
                            </div>
                            @error('program_studi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}">

                                @error('nomor_telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label for="" class="fw-bold">Usulan Pembimbing</label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="2">Pembimbing 1</th>
                                            <th colspan="2">Pembimbing 2</th>
                                        </tr>
                                        <tr>
                                            <th>Keilmuan</th>
                                            <th>Kuota</th>
                                            <th>Keilmuan</th>
                                            <th>Kuota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="keilmuan1">test</td>
                                            <td id="kuota1">test</td>
                                            <td id="keilmuan2">test</td>
                                            <td id="kuota2">test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <label for="pembimbing_satu">Pembimbing 1</label>
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-select" name="usulan_pembimbing_mhs1_id" id="pembimbing_satu">
                                  <option value="">Choose...</option>
                                  @foreach ($dospems as $dospem)
                                  
                                    <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama --- $dospem->keilmuan --- Kuota[$dospem->kuota_pembimbing]" }}</option>
                                  @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="pembimbing_dua">Pembimbing 2</label>
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-select" name="usulan_pembimbing_mhs2_id" id="pembimbing_dua">
                                  <option value="">Choose...</option>
                                  {{-- @foreach ($dospems as $dospem)
                                    <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama --- $dospem->keilmuan --- Kuota[$dospem->kuota_pembimbing]" }}</option>
                                  @endforeach --}}
                                </select>
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
                                <label for="foto_kwitansi" class="form-label">Upload Kwitansi Pembayaran TA</label>
                                <input class="form-control @error('foto_kwitansi') is-invalid @enderror" type="file" name="foto_kwitansi" id="foto_kwitansi">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>

                                @error('foto_kwitansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_khs" class="form-label">Upload KHS Terakhir</label>
                                <input class="form-control @error('foto_khs') is-invalid @enderror" type="file" name="foto_khs" id="foto_khs">
                                <small class="text-body-secondary">.jped, .png, .jpg. maks:2mb</small>

                                @error('foto_khs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_krs" class="form-label">Upload KRS Semester Berjalan</label>
                                <input class="form-control @error('foto_krs') is-invalid @enderror" type="file" name="foto_krs" id="foto_krs">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>

                                @error('foto_krs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_ktm" class="form-label">Upload KTM</label>
                                <input class="form-control @error('foto_ktm') is-invalid @enderror" type="file" name="foto_ktm" id="foto_ktm">
                                <small class="text-body-secondary">.jped, .png, .jpg, maks:2mb</small>

                                @error('foto_ktm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label for="" class="fw-bold">Outline Proposal TA/Skripsi</label>
                            <div class="mb-3">
                                <label for="topik_penelitian" class="form-label">Topik Penelitian</label>
                                <input type="text" class="form-control @error('topik_penelitian') is-invalid @enderror" name="topik_penelitian" id="topik_penelitian" placeholder="Topik Penelitian" required value="{{ old('topik_penelitian') }}">

                                @error('topik_penelitian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="proposal_ta" class="form-label">Upload Outline Proposal TA/Skripsi</label>
                                <input class="form-control @error('proposal_ta') is-invalid @enderror" type="file" name="proposal_ta" id="proposal_ta">
                                <small class="text-body-secondary">.pdf, maks:2mb</small>
                                
                                @error('proposal_ta')
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

@section('only-jquery')

<script>
    // Mendengarkan perubahan pada dropdown pertama
    document.getElementById('pembimbing_satu').addEventListener('change', function () {
        let selectedValuePertama = this.value;
        let pembimbing_dua = document.getElementById('pembimbing_dua');
        let pembimbing_satu = document.getElementById('pembimbing_satu');
        let keilmuanSatu = document.getElementById('keilmuan1');
        let kuotaSatu = document.getElementById('kuota1');
        let keilmuanDua = document.getElementById('keilmuan2');
        let kuotaDua = document.getElementById('kuota2');

        $.ajax({
            url: '/get-dospems/' + selectedValuePertama, // Mengirim selectedValuePertama sebagai parameter
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                pembimbing_dua.innerHTML = '';
                
                for (let i = 0; i < data.length; i++) {
                    let option = data[i];
                    
                    // Periksa apakah dosen sudah dipilih pada dropdown pertama
                    if (option['id'] !== selectedValuePertama) {
                        // Create an option element
                        let optionElement = document.createElement('option');
                        optionElement.value = option['id'];
                        optionElement.text = `${option['singkatan']} --- ${option['nama']} --- ${option['keilmuan']} --- Kuota[${option['kuota_pembimbing']}]`;

                        // Append the option element to pembimbing_dua
                        pembimbing_dua.appendChild(optionElement);
                    }
                }
            }
        });
    });
</script>

@endsection

@endsection