@extends('dashboard.pdf.layouts.main')

@section('container')
<h1 style="text-align: center;">Data Dosen Terdaftar</h1>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Singkatan</th>
            <th>Nomor Telepon</th>
            <th>Kuota Pembimbing</th>
            <th>Keilmuan</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($dosens as $dosen)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $dosen->nidn }}</td>
            <td>{{ $dosen->nama }}</td>
            <td>{{ $dosen->email }}</td>
            <td>{{ $dosen->singkatan }}</td>
            <td>{{ $dosen->nomor_telepon }}</td>
            <td>{{ $dosen->kuota_pembimbing }}</td>
            <td>{{ $dosen->keilmuan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection