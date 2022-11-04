@extends('layouts.app')

@php
    $emailFromCookie = Cookie::get('user_email_cookie');
@endphp
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center my-5">
                    <h1 class="fw-bold">Login</h1>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email"
                                       class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email', $emailFromCookie) }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password"
                                       class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember-email"
                                           id="remember-email" {{ $emailFromCookie || old('remember-email') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember-email">
                                        {{ __('Remember Email') }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="{{ route('register') }}" class="text-dark">Register now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
