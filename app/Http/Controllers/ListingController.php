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
    public function index() {
        $listings = Listing::where('user_id', '!=', Auth::id())
            ->paginate(25);
        return response()->json($listings);

    }
    public function store(Request $request, ListingService $listingService) {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $validatedData['image_path'] = $request->file('image_path');

       $listing = $listingService->store($validatedData);
        return response()->json($listing, 201);
    }

   public function show($id)
   {
       $listing = Listing::find($id);
       if (!$listing) {
           return response()->json('Message', 'No listing found');
       }
           return response()->json($listing);
       }

       public function update(Request $request, ListingService $listingService, Listing $listing) {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
         $listingUpdate = $listingService->update($listing, $validatedData);
         return response()->json($listingUpdate, 201);
       }

       public function destroy($id) {
        $listing = Listing::find($id);
        if(!$listing) {
            return response()->json('Message', 'No listing found');
        }
        $listing->delete();
        return response()->json('listing deleted', 201);
       }
   }
