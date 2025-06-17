<?php

namespace App\Services;
use App\Models\Listing;
use App\Models\User;

class ListingService {

    public function store(array $data): Listing {

        $path = $data['image_path']->store('images', 'public');

        $listing = Listing::create([
           'name' => $data['name'],
           'price' => $data['price'],
           'availability' => $data['availability'],
           'user_id' => Auth::user()->id,
            'image_path' => $path,
        ]);
        return $listing;
    }
}
