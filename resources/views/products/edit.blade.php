@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Editing: <span class="fw-bold">{{ $product->name }}</span></h1>

        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="row mb-3">
                <div class="row justify-content-center">
                    <img src="{{ asset('storage/' . $product->picture) }}" id="img-preview" class="img-thumbnail mb-3 d-block col-sm-3"
                         alt="{{ $product->name }}"/>
                </div>
                <label for="picture" class="col-sm-2 col-form-label text-muted">Picture</label>
                <div class="col-sm-10">
                    <input type="hidden" name="old_picture" value="{{ $product->picture }}">
                    <input
                        class="form-control @error('picture') is-invalid @enderror"
                        type="file" id="picture" name="picture" onchange="previewImage()">
                    @error('picture')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label text-muted">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" value="{{ $product->name }}" disabled />
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label text-muted">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                              name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-sm-2 col-form-label text-muted">Price</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                           name="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="stock" class="col-sm-2 col-form-label text-muted">Stock</label>
                <div class="col-sm-10">
                    <input type="number" min="1" class="form-control @error('stock') is-invalid @enderror" id="stock"
                           name="stock" value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="category" class="col-sm-2 col-form-label text-muted">Category Name</label>
                <div class="col-sm-10">
                    <select class="form-select" id="category" disabled>
                        <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>

    @push('scripts')
        <script>
            const previewImage = () => {
                const inputImg = document.querySelector('input#picture');
                const imgPreview = document.querySelector('#img-preview');
                const fileReader = new FileReader();
                fileReader.readAsDataURL(inputImg.files[0]);
                fileReader.onload = function (event) {
                    imgPreview.src = event.target.result;
                }
            }
        </script>
    @endpush
@endsection
