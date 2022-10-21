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

@if(session()->has('success'))
    @section('toasts')
        <div class="toast">
            <div class="toast-header bg-success text-white">
                <div class="rounded me-2">✅</div>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endsection
@endif

@section('content')
    <div class="container">
        @if($transactions->count())
            <h1 class="h2 mb-4">My Transactions</h1>
            @foreach($transactions as $transaction)
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ $transaction->created_at }}</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped align-middle">
                                <thead>
                                <tr>
                                    <th style="width: 25%">Product</th>
                                    <th style="width: 25%">Price</th>
                                    <th style="width: 25%">Qty</th>
                                    <th style="width: 25%">Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transaction->transactionDetails as $transactionDetail)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-nowrap gap-2  align-items-center">
                                                @if(Storage::disk('public')->exists($transactionDetail->picture))
                                                    <div class="product-image"
                                                         style="background-image: url('{{ asset('storage/' . $transactionDetail->picture) }}')"></div>
                                                @else
                                                    <div class="product-image"
                                                         style="background-image: url('{{ asset('img/placeholder/placeholder.png') }}')"></div>
                                                @endif
                                                <span>{{ $transactionDetail->name }}</span>
                                            </div>
                                        </td>
                                        <td>IDR {{ $transactionDetail->price }}</td>
                                        <td>{{ $transactionDetail->qty }}</td>
                                        <td>IDR {{ $transactionDetail->subtotal }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Grand Total</th>
                                    <th>IDR {{ number_format($transaction->transactionDetails->sum('subtotal'), 2) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>You don't have any transactions!</p>
        @endif
    </div>
@endsection
