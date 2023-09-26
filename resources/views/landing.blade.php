@extends('layouts.main')

@section('costum-style')
    <link rel="stylesheet" href="/css/style.css" />
@endsection

@section('container')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-sticky top-0 bg-white z-3">
        <div class="container">
            <img src="/img/logo.png" alt="Logo" width="120" class="d-inline-block align-text-top" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto align-items-center">
                    <a class="nav-link" aria-current="page" href="#home">Home</a>
                    <a class="nav-link" href="#about">About</a>
                    <a class="nav-link" href="#contact">Contact</a>
                </div>
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i>
                                    My
                                    Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="outline-button d-block" href="/login">
                        <span>LOGIN</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Home -->
    <section id="home"
        class="home container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="row container text-center mb-5">
            <div class="position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#00b4aa" class="bi bi-box satu"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg>
            </div>
            <div class="position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#00b4aa" class="bi bi-box dua"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg>
            </div>

            <div class="col-12 pb-5">
                <h1 class="fw-bolder title">Sistem Pengelolaan <br /><span>Tugas Akhir dan Yudisium</span></h1>
            </div>
            <div class="col-12">
                <p class="text-body-secondary desc">Sistem yang mengelola kegiatan <br />tugas akhir dan yudisium
                    berbasis web. <br />Membantu mendorong kinerja dan pelayanan yang lebih <br />efektif, cepat dan
                    efisien.</p>
            </div>
            <div class="col-12 col-md-12 d-md-flex justify-content-md-center d-grid gap-2 mx-auto">
                <a href="/login" class="outline-button">
                    <span class="fill-button">GET STARTED</span>
                </a>
                <a href="#about" class="outline-button">
                    <span>ABOUT</span>
                </a>
            </div>
            <div class="position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#00b4aa" class="bi bi-box tiga"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg>
            </div>
        </div>
    </section>
    <!-- End Home -->

    <!-- About -->
    <section id="about" class="about container vh-100">
        <p class="text-body-secondary">
            Perancangan dan pembangunan sistem yang dibuat meliputi proses pengajuan pendaftaran tugas akhir, penerimaan
            pengajuan pendaftaran, penerimaan SK pembimbing, bimbingan tugas akhir, penjadwalan, penilaian seminar dan
            sidang,
            pengalokasian dosen pembimbing, import data, penentuan topik tugas akhir dan penentuan yudisium.
        </p>

        <div class="row row-cols-1 row-cols-lg-2 gx-lg-5 gy-3">
            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Tugas Akhir</h5>
                        <p class="icon-description text-body-secondary me-2">Tugas Akhir merupakan kegiatan agenda studi
                            yang wajib di ikuti oleh seluruh mahasiswa prodi Informatika.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Yudisium</h5>
                        <p class="icon-description text-body-secondary me-2">Yudisium merupakan proses akademik yang
                            menyangkut penerapan nilai mahasiswa dari seluruh proses akademik.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- sub -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-3 gy-3 mt-2 sub-feature">
            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Pendaftaran TA</h5>
                        <p class="icon-description text-body-secondary me-2">Pendaftaran TA meliputi Pengajuan TA, Seminar dan Sidang.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Penerimaan SK</h5>
                        <p class="icon-description text-body-secondary me-2">Penerimaan SK terjadi setelah admin mengupload berkas SK mahasiswa.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Penjadwalan</h5>
                        <p class="icon-description text-body-secondary me-2">Penjadwalan meliputi penjadwalan seminar dan sidang TA.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Penilaian</h5>
                        <p class="icon-description text-body-secondary me-2">Penilaian meliputi penilaian seminar dan sidang oleh pembimbing maupun penguji</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Pengalokasian</h5>
                        <p class="icon-description text-body-secondary me-2">Pengalokasian dosen pembimbing dan penguji berdasarkan keahlian.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="primary-feature d-flex">
                    <div class="icon mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="55" fill="currentColor"
                            class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="icon-title fw-bold mb-1 mt-2">Import Data</h5>
                        <p class="icon-description text-body-secondary me-2">Impor data untuk memudahkan dalam mengelola data.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->

    <!-- Contact Us -->
    <section id="contact" class="contact container vh-100">
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 gx-5 gy-5">
            <div class="col d-flex flex-column justify-content-center text-center">
                <h4>Tell us your Problem</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <form action="/contact" method="POST" id="contact-form">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="nama"
                            placeholder="Nama" value="{{ old('nama') }}"/>
                        <label for="floatingNama">Nama</label>
                        @if ($errors->has('nama'))
                            <span class="text-danger">
                                {{ $errors->first('nama') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingEmail" name="email"
                            placeholder="name@example.com" value="{{ old('email') }}"/>
                        <label for="floatingEmail">Email address</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingSubject" name="subject"
                            placeholder="Subject" value="{{ old('subject') }}"/>
                        <label for="floatingSubject">Subject</label>
                        @if ($errors->has('subject'))
                            <span class="text-danger">
                                {{ $errors->first('subject') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a message here" id="floatingMessage" name="message"
                            style="height: 100px" value="{{ old('message') }}"></textarea>
                        <label for="floatingMessage">Message...</label>
                        @if ($errors->has('message'))
                            <span class="text-danger">
                                {{ $errors->first('message') }}
                            </span>
                        @endif
                    </div>
                    <div class="d-grid outline-button">
                        <button type="submit" class="fill-button">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <h2 class="fw-bolder">Our Location</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.566842248258!2d107.64814307581334!3d-6.942256767961911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c2d834ee57cb%3A0xf097d99bcccc4293!2sUniversitas%20Informatika%20Dan%20Bisnis%20Indonesia%20(UNIBI)!5e0!3m2!1sen!2sid!4v1685494396988!5m2!1sen!2sid"
                    width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- End Contact Us -->

    <!-- Footer -->
    <footer id="footer">
        <div class="text-center p-3">
            <h6 class="fw-lighter">@ 2023 Fakultas Teknologi dan Informatika UNIBI</h6>
        </div>
    </footer>
@endsection

@section('only-jquery')
    <script>
        $(document).ready(function() {

            $('#contact-form').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })

                $.ajax({
                    type: 'POST',
                    url: '/contact',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    location.href = "/"
                                }
                            })
                        } else {
                            // Form tidak berhasil dikirim, tampilkan pesan kesalahan jika perlu.
                            alert('Something went wrong. Please try again later.');
                        }
                    }
                });
            })

            
        })
    </script>
@endsection
