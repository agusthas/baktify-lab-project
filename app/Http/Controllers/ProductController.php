<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->query('search', '');
        $products = Product::query()
            ->with(['category', 'cartDetails'])
            ->search($searchQuery)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'picture' => ['required', 'mimes:jpg,jpeg,png'],
            'name' => ['required', 'min:5', 'max:255', 'unique:products,name'],
            'description' => ['required', 'min:15', 'max:500'],
            'price' => ['required', 'numeric', 'integer', 'between:1000,10000000'],
            'stock' => ['required', 'numeric', 'integer', 'between:1,10000'],
            'category_id' => ['required']
        ]);

        // Save picture to storage and get the path pointing there to be saved in DB
        $validatedData['picture'] = Storage::disk('public')
            ->putFile('images', $request->file('picture'));

        Product::create($validatedData);

        return redirect()
            ->route('products.index')
            ->with('success', "Success insert product :)");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->load(['category']);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = $product->load('category');
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'picture' => ['required', 'mimes:jpg,jpeg,png'],
            'description' => ['required', 'min:15', 'max:500'],
            'price' => ['required', 'numeric', 'integer', 'between:1000,10000000'],
            'stock' => ['required', 'numeric', 'integer', 'between:1,10000'],
        ]);

        // Delete prev image if exists
        if($request->hasFile('picture')) {
            Storage::disk('public')->delete($product->picture);
            $validatedData['picture'] = Storage::disk('public')
                ->putFile('images', $request->file('picture'));
        }

        $product->update($validatedData);

        return redirect()
            ->route('products.index')
            ->with("success", "Success update product :)");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('success', "Success Remove Product :)");
    }
}
