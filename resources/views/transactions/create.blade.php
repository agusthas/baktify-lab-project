@extends('layouts.app')

@push('styles')
    <style>
        {{-- TODO: bisa gak ini kita bikin general terus taroh di app.blade.php? --}}
        .product-image {
            width: 80px;
            height: 80px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container pb-4">
        <p class="h1 fw-bold mb-3">Checkout</p>
        <table class="table table-responsive align-middle text-nowrap">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart->cartDetails as $cartDetail)
                <tr>
                    <td>
                        <div class="d-flex flex-nowrap gap-3 align-items-center">
                            @if(Storage::disk('public')->exists($cartDetail->product->picture))
                                <div class="product-image"
                                     style="background-image: url('{{ asset('storage/' . $cartDetail->product->picture) }}')"></div>
                            @else
                                <div class="product-image"
                                     style="background-image: url('{{ asset('img/placeholder/placeholder.png') }}')"></div>
                            @endif
                            <span>{{ $cartDetail->product->name }}</span>
                        </div>
                    </td>
                    <td>IDR {{ $cartDetail->product->price }}</td>
                    <td>{{ $cartDetail->qty }}</td>
                    <td>IDR {{ $cartDetail->subtotal }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <th scope="row">Grand Total</th>
                <td>IDR {{ $cart->cartDetails->sum('subtotal') }}</td>
            </tr>
            </tfoot>
        </table>

        <div class="row mt-4">
            <div class="col-md-6 ms-auto">
                <div class="p-3 bg-light rounded-3">
                    <p>Ship to: {{ Auth::user()->address }}</p>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="passcode_confirmation" id="passcode_confirmation" value="{{ $passcode }}">
                        <div class="mb-2">
                            <label for="passcode" class="form-label">Please enter the following passcode to checkout:
                                <strong>{{ $passcode }}</strong></label>
                            <input class="form-control @error('passcode') is-invalid @enderror" type="text" name="passcode" id="passcode" placeholder="XXXXXX"
                                   required>
                            @error('passcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
