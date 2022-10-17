@extends('layouts.app')

@php /** @var \App\Models\Product $product */ @endphp
@section('content')
    <div class="container py-4 mt-4">
        <img src="{{ asset('storage/' . $product->picture) }}" class="img-thumbnail mb-3 d-block col-sm-3"
             alt="{{ $product->name }}"/>
        <h1 class="fw-bold">{{ $product->name }}</h1>
        <p class="text-muted">{{ $product->description }}</p>
        <p class="text-muted">Stock: {{ $product->stock }}</p>
        <p class="text-muted">Category: {{ $product->category->name }}</p>
    </div>
@endsection
