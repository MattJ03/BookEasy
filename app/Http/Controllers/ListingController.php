<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\User;
use App\Policies\ListingPolicy;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Listing::class);
        $listings = Listing::all();
        return response()->json($listings);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {                           //same as name in vue file
        $path = $request->file('image')->store('images', 'public');

        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
           'price' => 'required|numeric|min:0',
           'availability' => 'required|boolean',
           'image_path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $listing = Listing::create([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'availability' => $validatedData['availability'],
            'user_id' => Auth::user()->id,
            'image_path' => $path,
        ]);
        return response()->json(['message' => 'Listing Added', 'listing' => $listing]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
