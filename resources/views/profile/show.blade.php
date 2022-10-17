@extends('layouts.app')

@section('content')

    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h1 class="mb-4">Your profile</h1>

        <div class="mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <input type="text" class="form-control" id="name" disabled value="{{ $user->name }}"/>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" disabled value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" disabled value="{{ Str::random() }}">
            <div class="form-text">This is just a dummy password, not your real password :)</div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea id="address" class="form-control" disabled>{{ $user->address }}</textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" disabled value="{{ $user->phone }}">
            <div class="form-text">We will not misuse your phone number.</div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <a class="btn btn-primary" href="{{ route('profile.edit') }}">Update</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Sign Out</button>
            </form>
        </div>
    </div>
@endsection

