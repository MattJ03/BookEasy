<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    protected $fillable = ['name', 'price', 'availability', 'user_id', 'image_path'];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
