<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create', [
          "categories" => Category::with('products')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'name' => ['required', 'string', 'alpha', 'unique:categories,name']
        ]);

        Category::create($validatedData);

        return back()->with('success', 'Success creating a category :)');
    }
}
