@extends('layouts.app')
@php /** * @var \App\Models\User $user */ @endphp

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit your profile</h1>

        <form method="post" action="{{ route('profile.update') }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required/>
                @error('name')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" disabled value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required/>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address"
                          class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', $user->address) }}</textarea>
                @error('address')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                       value="{{ old('phone', $user->phone) }}" name="phone" required>
                @error('phone')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('profile.show') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
@endsection

