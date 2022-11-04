@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="fw-bold mb-4">Insert New Product</h1>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="row justify-content-center">
                    <img id="img-preview" class="img-thumbnail mb-3 d-block col-sm-3"/>
                </div>
                <label for="picture" class="col-sm-2 col-form-label text-muted">Picture</label>
                <div class="col-sm-10">
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label text-muted">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                              name="description">{{ old('description') }}</textarea>
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
                           name="price" value="{{ old('price') }}">
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
                           name="stock" value="{{ old('stock') }}">
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
                    <select class="form-select" id="category" name="category_id">
                        @foreach($categories as $category)
                            @if(old("category_id") == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
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
