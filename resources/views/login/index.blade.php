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
    <main class="form-signin">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
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
@endsection
