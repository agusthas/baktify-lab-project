@php
    $isAdmin = !Auth::guest() && Auth::user()->is_admin;
@endphp

@extends('layouts.app')

@push('styles')
    <style>
        .card-image-bg {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endpush
@section('content')
    <div class="container py-4 mt-4">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
            @if($isAdmin)
                <h1 class="fw-bold">Manage Products</h1>
            @else
                <h1 class="fw-bold">Our Products</h1>
            @endif
            <form class="row justify-content-end g-2" action="{{ route('products.index') }}">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="Search.." name="search"
                           value="{{ request('search') }}" aria-label="search"/>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        @if($isAdmin)
            <a href="{{ route('products.create') }}" class="mb-2 btn btn-info">Insert Product</a>
        @endif
        @if($products->count())
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card">
                            @if($product->stock === 0)
                                <div class="position-absolute m-1">
                                    <div class="badge bg-secondary text-uppercase mb-3">Out of stock</div>
                                </div>
                            @endif
                            @if(Storage::disk('public')->exists($product->picture))
                                <div class="card-image-bg card-img-top"
                                     style="background-image: url('{{ asset('storage/' . $product->picture) }}')"></div>
                            @else
                                <div class="card-image-bg card-img-top"
                                     style="background-image: url('{{ asset('img/placeholder/placeholder.png') }}')"></div>
                            @endif
                            <div class="card-body">
                                <div class="card-subtitle">{{ $product->name }}</div>
                                <div class="card-title fw-bold">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="badge bg-dark text-uppercase mb-3">{{ $product->category->name }}</div>
                                <div class="pt-3 border-top gap-2 d-flex justify-content-md-start">
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-sm btn-outline-success" type="button">View</a>
                                    @if(! $isAdmin)
                                        @if($product->cartDetails && $product->cartDetails->count() && !Auth::guest())
                                            <a href="{{ route('cart.index') }}" class="btn btn-sm btn-outline-dark">Show
                                                in Cart</a>
                                        @elseif($product->stock)
                                            <form action="{{ route('cartDetails.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="btn btn-sm btn-outline-primary" type="submit">Add to
                                                    Cart
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-sm btn-outline-warning" type="button">Edit</a>
                                        <form method="post"
                                              action="{{ route("products.destroy", $product->id) }}"
                                              class="d-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-outline-danger" type="submit"
                                                    onclick="return confirm('Are you sure?')">Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <p class="fs-4">Oops! No Product Match for '{{ request()->query('search') }}'</p>
        @endif
    </div>

    @if(session()->has('success'))
        @push('scripts')
            <script>
                alert("{{ session('success') }}");
            </script>
        @endpush
    @endif
@endsection
