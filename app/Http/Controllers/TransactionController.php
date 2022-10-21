<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::query()
            ->with('transactionDetails')
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->get();

        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $passcode = Str::random(6);
        $cart = Cart::query()->with('cartDetails')->where('user_id', Auth::user()->id)->firstOrFail();
        return view('transactions.create', [
            'cart' => $cart,
            'passcode' => $passcode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // check passcode sama gak sama input:hidden
        $request->validate([
            'passcode' => ['required', 'confirmed']
        ]);

        $user = Auth::user();
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->firstOrFail();

        $insertedData = $cart->cartDetails()
            ->with('product')
            ->get()
            ->map(function ($item, $index) {
               return [
                   'subtotal' => $item->subtotal,
                   'qty' => $item->qty,
                   'picture' => $item->product->picture,
                   'name' => $item->product->name,
                   'price' => $item->product->price
               ];
            })
            ->toArray();


        $transaction = Transaction::query()->create([
            'user_id' => $user->id
        ]);
        $transaction->transactionDetails()->createMany($insertedData);

        // Clear all cartDetails related to this cart
        $cart->cartDetails()->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', "Transaction success! You will receive our products soon! Thank you for shopping with us!");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
