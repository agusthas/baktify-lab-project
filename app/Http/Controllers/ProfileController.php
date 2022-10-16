<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function show(Request $request)
    {
        return view('profile.show', [
            'user' => $request->user()
        ]);
    }

    /**
     * Show the edit profile page.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update your profile.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'min:15'],
            'phone' => ['required', 'numeric', 'min:11']
        ]);

        $request->user()->update($validatedData);

        return redirect()->route('profile.show')->with('success', "Updated profile :)");
    }
}
