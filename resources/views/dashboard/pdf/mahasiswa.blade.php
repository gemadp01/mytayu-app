@extends('dashboard.pdf.layouts.main')

@section('container')

    <h1 style="text-align: center;">Data Mahasiswa Terdaftar</h1>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Prodi</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mahasiswa->npm }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->kelas }}</td>
                    <td>{{ $mahasiswa->prodi }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    
@endsection

