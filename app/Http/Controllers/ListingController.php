<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\User;
use App\Policies\ListingPolicy;
use Illuminate\Support\Facades\Auth;
use App\Services\ListingService;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListingService $listingService)
    {
      $listings = Listing::all();
      if(!$listings) {
          return response()->json(['message' => 'No listings were found.'], 422);
      }
      return response()->json($listings, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingService $listingService, Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999999999',
            'availability' => 'required|boolean',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);
        $listing = $listingService->store($validatedData);
        return response()->json($listing, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listing = Listing::find($id);
        if(!$listing) {
            return response()->json(['message' => 'listing cannot be found,'], 401);
        }
        return response()->json($listing, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing, ListingService $listingService)
    {
       $validatedData = $request->validatte([
           'name' => 'required|string|max:255',
           'price' => 'required|numeric|min:0|max:999999999',
           'availability' => 'required|boolean',
           'image_path' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

       ]);

       $listingUpdated = $listingService->update($validatedData, $listing);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
