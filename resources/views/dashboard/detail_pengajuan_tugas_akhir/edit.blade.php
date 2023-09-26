@extends('dashboard.layouts.main')

@section('page-heading')
    

    @can('IsKoordinator')
    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuanta->pengajuanta->nomor_pengajuan }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuanta->pengajuanta->tanggal_pengajuan }}</h6>
    </div>
    
    <div class="card shadow mb-4 m-0">
        <div class="card-header py-3 d-flex">
            <i class="fa fa-user pe-2" aria-hidden="true"></i>
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">NPM</li>
                        <li class="list-group-item">Nama</li>
                        <li class="list-group-item">Program Studi</li>
                        <li class="list-group-item">Kelas</li>
                        <li class="list-group-item">No HP</li>
                        <li class="list-group-item">Email</li>
                        <li class="list-group-item">Tahun Akademik</li>
                    </ul>
                </div>
                <div class="col-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->email }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->tahun_akademik }}</li>
                    </ul>
                    
                </div>
                <div class="col-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuanta->pengajuanta->status_pengajuan === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 1)
                                <span class="badge text-bg-warning">belum diperiksa oleh Koordinator KP/TA...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 2)
                                <span class="badge text-bg-warning">belum diperiksa oleh Kaprodi...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 3)
                                <span class="badge text-bg-warning">belum diperiksa oleh Dekan...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 4)
                                <span class="badge text-bg-success">Pengajuan Diterima...</span>
                            @endif
                        </li>
                        <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemPertama->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemPertama->nama }}</li>
                        <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemKedua->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemKedua->nama }}</li>
                    </ul>
                </div>
            </div>
    
            <div class="row">
                <div class="col-8">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                        </div>
                        <div class="card-body d-flex justify-content-evenly">
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" download>Download KTM</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" download>Download KHS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" download>Download KRS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                </div>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <div class="card shadow mb-4 m-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Proposal TA</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topik Penelitian yang diajukan : </li>
                                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->topik_penelitian }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->proposal_ta) }}" download>Download Proposal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/detail-pengajuan-ta/{{ $detailpengajuanta->id }}">
                                @method('put')
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_kwitansi" value="Diterima" id="kwitansi" @if ($detailpengajuanta->ket_kwitansi) checked @endif>
                                    <label class="form-check-label" for="kwitansi">
                                        Kwitansi
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_ktm" value="Diterima" id="ktm" @if ($detailpengajuanta->ket_ktm) checked @endif>
                                    <label class="form-check-label" for="ktm">
                                        KTM
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_khs" value="Diterima" id="khs" @if ($detailpengajuanta->ket_khs) checked @endif>
                                    <label class="form-check-label" for="khs">
                                        KHS
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ket_krs" value="Diterima" id="krs" @if ($detailpengajuanta->ket_krs) checked @endif>
                                    <label class="form-check-label" for="krs">
                                        KRS
                                    </label>
                                </div>
                                
                                <div class="card shadow mb-4 m-0">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="tanggapan_koordinator" id="tanggapan_koordinator" placeholder="Berikan tanggapan..." value="{{ $detailpengajuanta->tanggapan, old('tanggapan_koordinator') }}">
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Proses Pengajuan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    @endcan

    @can('IsKaprodi')

    <div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
        <h6 class="h6 mb-0 text-white p-2">
            No Pendaftaran : {{ $detailpengajuanta->pengajuanta->nomor_pengajuan }}
        </h6>
        <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $detailpengajuanta->pengajuanta->tanggal_pengajuan }}</h6>
    </div>
    
    <div class="card shadow mb-4 m-0">
        <div class="card-header py-3 d-flex">
            <i class="fa fa-user pe-2" aria-hidden="true"></i>
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-md-6 col-lg-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">NPM</li>
                        <li class="list-group-item">Nama</li>
                        <li class="list-group-item">Program Studi</li>
                        <li class="list-group-item">Kelas</li>
                        <li class="list-group-item">No HP</li>
                        <li class="list-group-item">Email</li>
                        <li class="list-group-item">Tahun Akademik</li>
                    </ul>
                </div>
                <div class="col-7 col-md-6 col-lg-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->npm }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nama }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->program_studi }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->kelas }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->nomor_telepon }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->email }}</li>
                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->tahun_akademik }}</li>
                    </ul>
                    
                </div>
                <div class="col-12 col-lg-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Status Pengajuan : 
                            @if ($detailpengajuanta->pengajuanta->status_pengajuan === 0)
                                <span class="badge text-bg-danger">revisi...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 1)
                                <span class="badge text-bg-warning">belum diperiksa oleh Koordinator KP/TA...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 2)
                                <span class="badge text-bg-warning">belum diperiksa oleh Kaprodi...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 3)
                                <span class="badge text-bg-warning">belum diperiksa oleh Dekan...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 4)
                                <span class="badge text-bg-success">Pengajuan Diterima...</span>
                            @endif
                            {{-- @if ($detailpengajuanta->pengajuanta->status_pengajuan === 2)
                            <span class="badge text-bg-success">diterima oleh koordinator...</span>
                            @elseif ($detailpengajuanta->pengajuanta->status_pengajuan === 5)
                            <span class="badge text-bg-danger">Pengajuan ulang pembimbing...</span>
                            @endif --}}
                        </li>
                        <li class="list-group-item">Usulan Pembimbing 1 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemPertama->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemPertama->nama }}</li>
                        <li class="list-group-item">Usulan Pembimbing 2 dari Mahasiswa :</li>
                        <li class="list-group-item">{{ "( ". $detailpengajuanta->pengajuanta->usulanDospemKedua->singkatan ." ) " . $detailpengajuanta->pengajuanta->usulanDospemKedua->nama }}</li>
                    </ul>
                </div>
            </div>
    
            <div class="row flex-column flex-lg-row">
                <div class="col-12 col-lg-8">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berkas Lampiran</h6>
                        </div>
                        <div class="card-body d-flex justify-content-evenly">
                        
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_ktm) }}" download>Download KTM</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_khs) }}" download>Download KHS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_krs) }}" download>Download KRS</a>
                                </div>
                            </div>
    
                            <div class="card" style="width: 10rem;">
                                <img src="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <a class="card-text" href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->foto_kwitansi) }}" download>Download Kwitansi</a>
                                </div>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <div class="card shadow mb-4 m-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Proposal TA</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Topik Penelitian yang diajukan : </li>
                                        <li class="list-group-item">{{ $detailpengajuanta->pengajuanta->topik_penelitian }}</li>
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/' . $detailpengajuanta->pengajuanta->proposal_ta) }}" download>Download Proposal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow mb-4 m-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dashboard/detail-pengajuan-ta/{{ $detailpengajuanta->id }}">
                                @method('put')
                                @csrf                               
                                <label for="" class="fw-bold">Usulan Pembimbing</label>
                                <div>
                                    <label for="pembimbing_satu">Usulan Pembimbing 1</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="usulan_pembimbing_kaprodi1_id" id="pembimbing_satu">
                                    @if ($detailpengajuanta->pengajuanta->status_pengajuan === 5)    
                                    <option value="{{ $detailpengajuanta->usulanDospemKaprodiPertama->id }}" selected>
                                        {{  "$dospem_kaprodi1->singkatan --- $dospem_kaprodi1->nama --- $dospem_kaprodi1->keilmuan --- Kuota[$dospem_kaprodi1->kuota_pembimbing]" }}
                                    </option>

                                    @elseif ($detailpengajuanta->usulan_pembimbing_kaprodi1_id !== null)
                                    <option value="{{ $detailpengajuanta->usulan_pembimbing_kaprodi1_id }}">
                                        {{  "$dospem_kaprodi1->singkatan --- $dospem_kaprodi1->nama --- $dospem_kaprodi1->keilmuan --- Kuota[$dospem_kaprodi1->kuota_pembimbing]" }}
                                    </option>

                                    @else

                                    <option value="{{ $detailpengajuanta->pengajuanta->usulan_pembimbing_mhs1_id }}">{{  "$dospem_mhs1->singkatan --- $dospem_mhs1->nama --- $dospem_mhs1->keilmuan --- Kuota[$dospem_mhs1->kuota_pembimbing]" }}</option>
                                    @endif

                                    @foreach ($dospems as $dospem)
                                        @if ($dospem->id !== $detailpengajuanta->pengajuanta->usulan_pembimbing_mhs1_id)
                                            <option value="{{ $dospem->id }}">{{  "$dospem->singkatan --- $dospem->nama --- $dospem->keilmuan --- Kuota[$dospem->kuota_pembimbing]" }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="pembimbing_dua">Usulan Pembimbing 2</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="usulan_pembimbing_kaprodi2_id" id="pembimbing_dua">
                                    @if ($detailpengajuanta->pengajuanta->status_pengajuan === 5)    
                                    <option value="{{ $detailpengajuanta->usulan_pembimbing_kaprodi2_id }}">
                                        {{  "$dospem_kaprodi2->singkatan --- $dospem_kaprodi2->nama --- $dospem_kaprodi2->keilmuan --- Kuota[$dospem_kaprodi2->kuota_pembimbing]" }}
                                    </option>
                                    @elseif ($detailpengajuanta->usulan_pembimbing_kaprodi2_id !== null)
                                    <option value="{{ $detailpengajuanta->usulan_pembimbing_kaprodi2_id }}">
                                        {{  "$dospem_kaprodi2->singkatan --- $dospem_kaprodi2->nama --- $dospem_kaprodi2->keilmuan --- Kuota[$dospem_kaprodi2->kuota_pembimbing]" }}
                                    </option>
                                    @else

                                    <option value="{{ $detailpengajuanta->pengajuanta->usulan_pembimbing_mhs2_id }}">
                                        {{  "$dospem_mhs2->singkatan --- $dospem_mhs2->nama --- $dospem_mhs2->keilmuan --- Kuota[$dospem_mhs2->kuota_pembimbing]" }}
                                    </option>
                                    @endif
                                    </select>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Proses Pengajuan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    @endcan

    @section('only-jquery')

    <script>
        // Mendengarkan perubahan pada dropdown pertama
        document.getElementById('pembimbing_satu').addEventListener('change', function () {
            let selectedValuePertama = this.value;
            let pembimbing_dua = document.getElementById('pembimbing_dua');
            
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