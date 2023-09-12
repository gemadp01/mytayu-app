@extends('layouts.main')

@section('costum-style')
    <link rel="stylesheet" href="/css/signin.css">
    <style>
        <style>.bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    </style>
@endsection


@section('container')
    <div class="vh-100 vw-100 d-flex align-items-center" style="background: rgb(0,180,170);
    background: radial-gradient(circle, rgba(0,180,170,0) 46%, rgba(0,180,170,0.5527398459383753) 100%);">
        <main class="form-signin">

            <div class="d-flex justify-content-center">
                <img src="img/unibi.png" alt="UNIBI" width="70">
            </div>
    
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/login" method="post">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please Login</h1>
    
                <div class="form-floating">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        id="username" placeholder="NIDN/NPM" autofocus required value="{{ old('username') }}" />
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                    <label for="password">Password</label>
                </div>
    
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </main>
    </div>
@endsection
