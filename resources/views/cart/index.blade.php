@extends('layouts.app')

@push('styles')
    <style>
        .product-image {
            width: 50px;
            height: 50px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        @if($cart && $cart->count())
            <h1 class="h2 mb-4">My Cart</h1>
            <div class="overflow-auto">
                <table class="table table-stripped table-responsive align-middle text-nowrap">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->cartDetails as $cartDetail)
                        <tr>
                            <td>
                                <div class="d-flex flex-nowrap gap-2  align-items-center">
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
                            <td>
                                IDR {{ $cartDetail->product->price }}
                            </td>
                            <td style="min-width: 90px">
                                <form id="updateCart{{ $cartDetail->id }}"
                                      action="{{ route('cartDetails.update', $cartDetail->id) }}"
                                      method="POST"
                                >
                                    @csrf
                                    @method('patch')
                                    <label for="qty" hidden>Quantity</label>
                                    <input type="number" class="form-control form-control-sm text-nowrap" name="qty"
                                           id="qty" min="0" max="{{ $cartDetail->product->stock }}"
                                           value="{{ $cartDetail->qty }}"/>
                                </form>
                            </td>
                            <td>
                                IDR {{ $cartDetail->subtotal }}
                            </td>
                            <td>
                                <button form="updateCart{{ $cartDetail->id }}" type="submit"
                                        class="btn btn-sm btn-primary">Update Cart
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Grand Total</th>
                        <td>IDR {{ $cart->cartDetails->sum('subtotal') }}</td>
                        <td>
                            {{-- TODO: redirect to checkout page --}}
                            <a href="#" class="btn btn-sm btn-success">Checkout</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <h1 class="h2">Empty Cart :(</h1>
            <p>Your cart is currently empty. <a href="{{ route('products.index') }}" class="link-primary">Browse our
                    products</a> and add it to your cart to see them here</p>
        @endif
    </div>
@endsection
