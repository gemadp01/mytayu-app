@extends('dashboard.layouts.main')

@section('page-heading')
    
{{-- @dd($pilihanPenguji) --}}

@can('IsKaprodi')
{{-- @dd($data_pengajuan->id) --}}
<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $data_pengajuan->pengajuansidangta->no_pengajuan_sidang }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $data_pengajuan->pengajuansidangta->tanggal_pengajuan }}</h6>
</div>

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3 d-flex">
        <i class="fa fa-user pe-2" aria-hidden="true"></i>
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Sidang Tugas Akhir</h6>
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
                    <li class="list-group-item">Judul Penelitian Tugas Akhir</li>
                </ul>
            </div>
            <div class="col-7 col-md-6 col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->npm }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nama }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->program_studi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->kelas }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nomor_telepon }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->email }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->judul_sdta }}</li>
                </ul>
                
            </div>
            <div class="col-12 col-lg-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Pengajuan : 
                        {{-- @if ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
                        @else
                            <span class="badge text-bg-success">diterima...</span>
                        @endif --}}
                        @if ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 2)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 3)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 4)
                            <span class="badge text-bg-success">Pengajuan Diterima...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 5)
                            <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="row flex-column flex-lg-row">

            <div class="col-12">
                <div class="card shadow mb-4 m-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Input Data Penguji</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <label for="pembimbing1_id">Dosen Pembimbing 1</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="pembimbing1_id" id="pembimbing1_id" disabled>
                                        <option value="{{ $data_pengajuan->pembimbing1_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing1_id)->pluck('nama')->first() }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div>
                                    <label for="pembimbing1_id">Dosen Pembimbing 2</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="pembimbing2_id" id="pembimbing2_id" disabled>
                                        <option value="{{ $data_pengajuan->pembimbing2_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing2_id)->pluck('nama')->first() }}</option>
                                    </select>
                                </div>
                            </div>

                            <form method="post" action="/dashboard/usulan-penguji-sidang/{{ $data_pengajuan->id }}">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <label for="penguji1_id">Dosen Penguji 1</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="penguji1_id" id="penguji1_id">
                                                <option value="">Choose...</option>

                                                @foreach ($pilihanPenguji as $pp)
                                                <option value="{{ $pp->id }}">
                                                    {{ $pp->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div>
                                            <label for="penguji2_id">Dosen Penguji 2</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="penguji2_id" id="penguji2_id">
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Submit Penguji</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>      
            </div>
        </div>

        

    </div>
</div>
@endcan

@can('IsDekan')
    
<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-primary" style="border-radius: 5px">
    <h6 class="h6 mb-0 text-white p-2">
        No Pendaftaran : {{ $data_pengajuan->pengajuansidangta->no_pengajuan_sidang }}
    </h6>
    <h6 class="h6 mb-0 text-white p-2">Tanggal Pengajuan : {{ $data_pengajuan->pengajuansidangta->tanggal_pengajuan }}</h6>
</div>

<div class="card shadow mb-4 m-0">
    <div class="card-header py-3 d-flex">
        <i class="fa fa-user pe-2" aria-hidden="true"></i>
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan Sidang Tugas Akhir</h6>
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
                    <li class="list-group-item">Judul Penelitian Tugas Akhir</li>
                </ul>
            </div>
            <div class="col-7 col-md-6 col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->npm }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nama }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->program_studi }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->kelas }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->nomor_telepon }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->email }}</li>
                    <li class="list-group-item">{{ $data_pengajuan->pengajuansidangta->judul_sdta }}</li>
                </ul>
                
            </div>
            <div class="col-12 col-lg-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Pengajuan : 
                        {{-- @if ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning">belum diperiksa...</span>
                        @else
                            <span class="badge text-bg-success">diterima...</span>
                        @endif --}}
                        @if ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 0)
                            <span class="badge text-bg-danger">revisi...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 1)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Koordinator</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 2)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Kaprodi...</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 3)
                            <span class="badge text-bg-warning text-start">belum diperiksa <div>oleh Dekan...</div></span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 4)
                            <span class="badge text-bg-success">Pengajuan Diterima...</span>
                        @elseif ($data_pengajuan->pengajuansidangta->status_pengajuan_sidang === 5)
                            <span class="badge text-bg-warning text-start">Pengajuan ulang <div>sedang diproses...</div></span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="row flex-column flex-lg-row">

            <div class="col-12">
                <div class="card shadow mb-4 m-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Input Data Penguji</h6>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="/dashboard/usulan-penguji-sidang/{{ $data_pengajuan->id }}">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="pembimbing1_id">Dosen Pembimbing 1</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="pembimbing1_id" id="pembimbing1_id" disabled>
                                            <option value="{{ $data_pengajuan->pembimbing1_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing1_id)->pluck('nama')->first() }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for=""></label>
                                    </div>
                                    <input type="radio" class="btn-check" name="penguji_utama_id" id="1" autocomplete="off" checked value="{{ $data_pengajuan->pembimbing1_id }}">
                                    <label class="btn btn-secondary" for="1">Penguji Utama</label>
                                    <input type="radio" class="btn-check" name="uji1_id" id="2" autocomplete="off" value="{{ $data_pengajuan->pembimbing1_id }}">
                                    <label class="btn btn-secondary" for="2">Uji 1</label>
                                    <input type="radio" class="btn-check" name="uji2_id" id="3" autocomplete="off" value="{{ $data_pengajuan->pembimbing1_id }}">
                                    <label class="btn btn-secondary" for="3">Uji 2</label>
                                    <input type="radio" class="btn-check" name="uji3_id" id="4" autocomplete="off" value="{{ $data_pengajuan->pembimbing1_id }}">
                                    <label class="btn btn-secondary" for="4">Uji 3</label>
                                </div>
    
                                <div class="col-6">
                                    <div>
                                        <label for="pembimbing1_id">Dosen Pembimbing 2</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="pembimbing2_id" id="pembimbing2_id" disabled>
                                            <option value="{{ $data_pengajuan->pembimbing2_id }}">{{ $infoDosen->where('id', $data_pengajuan->pembimbing2_id)->pluck('nama')->first() }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for=""></label>
                                    </div>
                                    <input type="radio" class="btn-check" name="penguji_utama_id" id="5" autocomplete="off" value="{{ $data_pengajuan->pembimbing2_id }}">
                                    <label class="btn btn-secondary" for="5">Penguji Utama</label>
                                    <input type="radio" class="btn-check" name="uji1_id" id="6" autocomplete="off" checked value="{{ $data_pengajuan->pembimbing2_id }}">
                                    <label class="btn btn-secondary" for="6">Uji 1</label>
                                    <input type="radio" class="btn-check" name="uji2_id" id="7" autocomplete="off" value="{{ $data_pengajuan->pembimbing2_id }}">
                                    <label class="btn btn-secondary" for="7">Uji 2</label>
                                    <input type="radio" class="btn-check" name="uji3_id" id="8" autocomplete="off" value="{{ $data_pengajuan->pembimbing2_id }}">
                                    <label class="btn btn-secondary" for="8">Uji 3</label>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for="penguji1_id">Dosen Penguji 1</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="penguji1_id" id="penguji1_id" disabled>
                                            <option value="{{ $data_pengajuan->penguji1_id }}">{{ $infoDosen->where('id', $data_pengajuan->penguji1_id)->pluck('nama')->first() }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for=""></label>
                                    </div>
                                    <input type="radio" class="btn-check" name="penguji_utama_id" id="9" autocomplete="off" value="{{ $data_pengajuan->penguji1_id }}">
                                    <label class="btn btn-secondary" for="9">Penguji Utama</label>
                                    <input type="radio" class="btn-check" name="uji1_id" id="10" autocomplete="off" value="{{ $data_pengajuan->penguji1_id }}">
                                    <label class="btn btn-secondary" for="10">Uji 1</label>
                                    <input type="radio" class="btn-check" name="uji2_id" id="11" autocomplete="off" checked value="{{ $data_pengajuan->penguji1_id }}">
                                    <label class="btn btn-secondary" for="11">Uji 2</label>
                                    <input type="radio" class="btn-check" name="uji3_id" id="12" autocomplete="off" value="{{ $data_pengajuan->penguji1_id }}">
                                    <label class="btn btn-secondary" for="12">Uji 3</label>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for="penguji2_id">Dosen Penguji 2</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select class="form-select" name="penguji2_id" id="penguji2_id" disabled>
                                            <option value="{{ $data_pengajuan->penguji2_id }}">{{ $infoDosen->where('id', $data_pengajuan->penguji2_id)->pluck('nama')->first() }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for=""></label>
                                    </div>
                                    <input type="radio" class="btn-check" name="penguji_utama_id" id="13" autocomplete="off" value="{{ $data_pengajuan->penguji2_id }}">
                                    <label class="btn btn-secondary" for="13">Penguji Utama</label>
                                    <input type="radio" class="btn-check" name="uji1_id" id="14" autocomplete="off" value="{{ $data_pengajuan->penguji2_id }}">
                                    <label class="btn btn-secondary" for="14">Uji 1</label>
                                    <input type="radio" class="btn-check" name="uji2_id" id="15" autocomplete="off" value="{{ $data_pengajuan->penguji2_id }}">
                                    <label class="btn btn-secondary" for="15">Uji 2</label>
                                    <input type="radio" class="btn-check" name="uji3_id" id="16" autocomplete="off" checked value="{{ $data_pengajuan->penguji2_id }}">
                                    <label class="btn btn-secondary" for="16">Uji 3</label>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit Penguji</button>
                                </div>
                            </div>
                        </form>
                            
                        
                    </div>
                </div>      
            </div>
        </div>

        

    </div>
</div>

@endcan

@endsection

@section('only-jquery')
<script>
    $(document).ready(function() {
        // Mendengarkan perubahan pada dropdown pertama
        document.getElementById('penguji1_id').addEventListener('change', function () {
            let selectedValuePertama = this.value;
            let pembimbing1_id = document.getElementById('pembimbing1_id').value;
            let pembimbing2_id = document.getElementById('pembimbing2_id').value;
            let penguji2_id = document.getElementById('penguji2_id');

            // console.log(selectedValuePertama);

            $.ajax({
                url: '/dashboard/usulan-penguji-sidang/get-penguji/' + pembimbing1_id + '/' + pembimbing2_id, // Mengirim selectedValuePertama sebagai parameter
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    penguji2_id.innerHTML = '';
                    
                    for (let i = 0; i < data.length; i++) {
                        let option = data[i];
                        
                        // Periksa apakah dosen sudah dipilih pada dropdown pertama
                        if (option['id'] != selectedValuePertama) {
                            // Create an option element
                            let optionElement = document.createElement('option');
                            optionElement.value = option['id'];
                            optionElement.text = `${option['nama']}`;

                            // Append the option element to pembimbing_dua
                            penguji2_id.appendChild(optionElement);
                        }
                    }
                }
            });
        });
    })
</script>
@endsection