<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    protected function avgStars() : Attribute
    {
        $reviews = $this->reviews;
        return Attribute::make(
            get: fn($i) => round($reviews->pluck('stars')->avg(),1)
        );
    }

 
}
