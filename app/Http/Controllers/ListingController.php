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
            'user_id' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

       $listing = $listingService->store($validatedData);
        return response()->json($listing, 201);
    }

   public function show($id) {
        $listing = Listing::find($id);
        if(!$listing) {}
        return response()->json('Message', 'No listing found');
   }

}
