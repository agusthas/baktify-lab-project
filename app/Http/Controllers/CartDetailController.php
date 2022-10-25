<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required']
        ]);

        $user = $request->user();
        $product = Product::query()
            ->findOrFail($data['product_id']);

        // FLOW
        // 1. check if cart for this current user exist
        // 2. if yes, update. if not, create.
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->first();

        if (!$cart) {
            $cart = Cart::query()->create([
                'user_id' => $user->id
            ]);
        }

        $cartDetail = CartDetail::query()
            ->where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();


        if (!$cartDetail) {
            $qty = 1;
            $subtotal = $product->price * $qty;
            CartDetail::query()
                ->create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'subtotal' => $subtotal
                ]);
        } else {
            $qty = $cartDetail->qty;
            $subtotal = $cartDetail->subtotal;
            $cartDetail->update([
                'qty' => $qty + 1, // increments
                'subtotal' => $subtotal + $product->price
            ]);
        }


        return redirect()->route('cart.index')->with('success', 'Successfully add to cart :)');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CartDetail $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CartDetail $cartDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CartDetail $cartDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CartDetail $cartDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CartDetail $cartDetail)
    {
        $data = $request->validate([
           'qty' => ['required', 'numeric', 'integer', 'min:0']
        ]);

        // Validating qty cannot exceed product stock
        $qty = $data['qty'];
        $stock = $cartDetail->product->stock;
        if($stock < $qty) {
            return back()->withErrors('Quantity cannot exceed the current stock. :(');
        }

        if($qty == 0) {
            return $this->destroy($cartDetail);
        }

        // Updating qty in database
        $newSubtotal = $qty * $cartDetail->product->price;
        $cartDetail->update([
            'qty' => $qty,
            'subtotal' => $newSubtotal
        ]);

        return redirect()->route('cart.index')->with('success', 'Successfully updated cart item. :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CartDetail $cartDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CartDetail $cartDetail)
    {
        $cartDetail->delete();
        return redirect()->route('cart.index')->with('success', 'Successfully remove cart item. :)');
    }
}
